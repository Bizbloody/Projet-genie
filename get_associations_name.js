function displayAssociation() {
    fetch('get_associations_name.php')
        .then(response => response.json())
        .then(data => {
            const assoSelect = document.getElementById('association');


            assoSelect.innerHTML = '';

            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Sélectionnez une association';
            assoSelect.appendChild(defaultOption);

            data.forEach(association => {
                const option = document.createElement('option');
                option.value = association.ID;
                option.textContent = association.nom;
                assoSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching associations:', error));
}

document.addEventListener('DOMContentLoaded', (event) => {
    displayAssociation();
});