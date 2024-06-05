

console.log('test_script.js is loaded'); // Add this line

document.addEventListener('DOMContentLoaded', 
function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    selectable: true,
    locale: {
      code: 'fr',
      week: {
        dow: 1,
        doy: 4, // The week that contains Jan 4th is the first week of the year.
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
    bookIfAvailable(info.startStr, info.endStr, resName = reservationName)
  //   fetchAvailablePlaces(info.startStr, info.endStr)
  //   .then(places => {
  //     // Display available places in a modal
  //     displayAvailablePlacesInModal(places, reservationName, info);
  //   })
  //   .catch(error => {
  //     console.error('Error fetching available places:', error);
  //   });

  //   const selectedEvent = {
  //     title: reservationName,
  //     start: info.startStr,
  //     end: info.endStr,
  //     rendering: 'background', // Render as a background event
  //     backgroundColor: 'yellow', // Set the background color
  //     textColor: 'black'

  //   };

  //   const reservationData = {
  //     name: reservationName,
  //     start: info.startStr,
  //     end: info.endStr
  //   };

  // saveReservation(reservationData);

  }

  // Render the selected event on the calendar
  //calendar.addEvent(selectedEvent);
},
    })
    calendar.render();

    // Function to send reservation data to the server
    // function saveReservation(reservationData) {
    //   // Send reservation data to the server using AJAX
    //   const xhr = new XMLHttpRequest();
    //   xhr.open('POST', 'test_php.php', true);
    //   xhr.setRequestHeader('Content-Type', 'application/json');
    //   xhr.onload = function() {
    //       if (xhr.status === 200) {
    //           // Handle successful response from the server
    //           console.log('Reservation saved successfully.');
    //       } else {
    //           // Handle error response from the server
    //           console.error('Error saving reservation:', xhr.statusText);
    //       }
    //   };
    //   xhr.onerror = function() {
    //       // Handle connection errors
    //       console.error('Error sending request to the server.');
    //   };
    //   xhr.send(JSON.stringify(reservationData));
    // }
  });

 /* function fetchAvailablePlaces(startDate, endDate) {
    return new Promise((resolve, reject) => {
      // Simulated example - replace with your actual implementation
      const availablePlaces = [
        { id: 1, name: 'Place 1', info: 'More info about Place 1' },
        { id: 2, name: 'Place 2', info: 'More info about Place 2' },
        { id: 3, name: 'Place 3', info: 'More info about Place 3' }
      ];
      resolve(availablePlaces);
      return;
    });
  } */


  const bookIfAvailable = (start = "", end = "", lieu = "", resName = "") => {

    const params = new URLSearchParams()
    params.set("start", start)
    params.set("end", end)
    params.set("lieu",lieu)


    const encodedUrl = "getBooking.php?" + params.toString()
    console.log(encodedUrl)

    return fetch(encodedUrl)
    .then(result => result.json())
    .then(data => {
      console.log(data)
      const info =   data.map(elem => elem.nom + ", ");
      console.log(data)
      alert("Les salles suivantes sont occupée :" + data.map(elem => " "+elem.nom))

      const postUrl = "postBooking.php"

      const body = {
        name : resName,  
        start : start,
        end : end,
        lieuId : 1      //todo change lieuId with the correct place for the reservation
      }

      return fetch(postUrl, {
        method : "POST",
        body: JSON.stringify(body),
      })
      .then(console.log("Reservation is saved !"))

      
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