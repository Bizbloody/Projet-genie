


document.addEventListener('DOMContentLoaded', 
function() {
  var calendarEl = document.getElementById('calendar');

  var lieuList = document.getElementById('selectedStorage');

  
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    selectable: true,
    locale: {
      code: 'fr',
      week: {
        dow: 1,
        doy: 4,
      },
      buttonText: {
        prev: 'Précédent',
        next: 'Suivant',
        today: 'Aujourd\'hui',
        year: 'Année',
        month: 'Mois',
        week: 'Semaine',
        day: 'Jour',
        list: 'Planning',
      },

      weekText: 'Sem.',
      weekTextLong: 'Semaine',
      allDayText: 'Toute la journée',
      moreLinkText: 'en plus',
      noEventsText: 'Aucun évènement à afficher',
    },
    select: function(info) {  
        // Prompt the user to enter the reservation name
  const reservationName = prompt('Enter the name of the reservation:'); 
 
  if (reservationName === null) {
      return;
  }else{
    const lieuID = lieuList.selectedOptions[0].id
    bookIfAvailable(info.startStr, info.endStr,resName = reservationName, lieuId=lieuID)
      .then(() => {
        
        renderCalendarEventsFromLieuId(calendar,lieuID)
      })
  }
},
  })

    lieuList.addEventListener('change', 
    function(event) {
      let selectedOption = event.target.selectedOptions[0];
      renderCalendarEventsFromLieuId(calendar,selectedOption.id)
    })
  
    getAllLieuAndPolulationLieuList(lieuList)
    .then(() => {
      const lieuId = lieuList.selectedOptions[0].id
      renderCalendarEventsFromLieuId(calendar,lieuId)
    })
    
    calendar.render();


  });

  const bookIfAvailable = (start = "", end = "",resName = "", lieuId = 0) => {

    const params = new URLSearchParams()
    params.set("start", start)
    params.set("end", end)
    params.set("lieuId",lieuId)


    const encodedUrl = "../Controller/get_booking.php?"+params.toString()
    
    return fetch(encodedUrl)
    .then(result => result.json())
    .then(data => {
    
      if(data.map(elem => elem.ID).includes(lieuId)){
        alert("Cette salee est deja reservée sur cette plage de date. Veuillez en choisisr une nouvelle.")
        return;
      }

      const postUrl = "../Controller/post_booking.php"

      const body = {
        name : resName,  
        start : start,
        end : end,
        lieuId : lieuId
      }

      return fetch(postUrl, {
        method : "POST",
        body: JSON.stringify(body),
      })
      
      
    })
    
  }

  const getReservationsFromLieuId = (lieuId) => {

    const params = new URLSearchParams()
    params.set("lieuId",lieuId)

      const encodedUrl = "../Controller/get_reservations_from_lieu.php?"+params.toString()
      return fetch(encodedUrl)
        .then(result => result.json());
  }

  const getAllLieuAndPolulationLieuList = (lieuList) => {
      const url = "../Controller/get_all_lieu.php";

      return fetch(url)
        .then(result => result.json())
        .then(data => {

          data.map(element => {
            const option = document.createElement('option')
            option.setAttribute("id",element.ID)
            option.setAttribute("value",element.nom)
            option.innerHTML = element.nom;
            lieuList.appendChild(option);
          })
          
          
        })
        
  }


  const renderCalendarEventsFromLieuId = (calendar,lieuId) => {
    calendar.removeAllEvents();

    getReservationsFromLieuId(lieuId)
    .then(data => {
      data.map(element => {
        const event = {
          title: element.reservation_name,
          start: element.date_debut,
          end: element.date_fin,
          rendering: 'background',
          backgroundColor: '#ab2346',
          textColor: 'white',
        }

        calendar.addEvent(event)
      })
    })

    
   
  }

  function displayAvailablePlacesInModal(places, reservationName, info) {
    const modal = document.getElementById("myModal");
    const placeList = document.getElementById("placeList");
    
    // Clear any existing place list
    placeList.innerHTML = '';
  
    // Populate the place list
    places.forEach(place => {
      const listItem = document.createElement("li");
      const placeLink = document.createElement("a");
      placeLink.href = "#";
      placeLink.classList.add("place-link");
      placeLink.setAttribute('data-place-id', place.id);
      placeLink.textContent = place.name;
      listItem.appendChild(placeLink);
      placeList.appendChild(listItem);
    });
  
    // Display the modal
    modal.style.display = "block";
  
    // Add event listeners for place links
    document.querySelectorAll('.place-link').forEach(link => {
      link.addEventListener('click', function(event) {
        event.preventDefault();
        const placeId = parseInt(this.getAttribute('data-place-id'));
        const selectedPlace = places.find(place => place.id === placeId);
        // Show more information about the selected place
        alert(`Selected ${info.startStr} to ${info.endStr}\nReservation Name: ${reservationName}\nPlace: ${selectedPlace.name}\nInfo: ${selectedPlace.info}`);
        // Close the modal after displaying information
        modal.style.display = "none";
      });
    });
  
    // Add event listener for closing the modal
    const closeBtn = document.querySelector('.close');
    closeBtn.addEventListener('click', function() {
      modal.style.display = "none";
    });
  
    // Close the modal when clicking outside of it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  }