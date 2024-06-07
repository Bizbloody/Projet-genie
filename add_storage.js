function validateForm() {
    // Clear previous errors
    document.querySelectorAll('.error').forEach(e => e.textContent = '');

    const name = document.forms["add_storage"]["name"].value;
    const association = document.forms["add_storage"]["association"].value;
    const type = document.forms["add_storage"]["type"].value;
    const width = document.forms["add_storage"]["width"].value;
    const length = document.forms["add_storage"]["length"].value;
    const deepness = document.forms["add_storage"]["deepness"].value;
    const campus = document.forms["add_storage"]["campus_select"].value;
    const floor = document.forms["add_storage"]["floor"].value;
    const description = document.forms["add_storage"]["description"].value;

    let valid = true;

    // Validation for name: alphanumeric, 3 to 50 characters, required
    if (!/^[a-zA-Z0-9\s]{3,50}$/.test(name)) {
        document.getElementById('nameError').textContent = "Le nom doit être alphanumérique et contenir entre 3 et 50 caractères.";
        valid = false;
    }

    // Validation for type: required
    if (type === "") {
        document.getElementById('typeError').textContent = "Le type de rangement est obligatoire.";
        valid = false;
    }

    // Validation for width, length, and deepness: integer, in cm
    if (!/^\d+$/.test(width)) {
        document.getElementById('widthError').textContent = "La largeur doit être un entier en cm.";
        valid = false;
    }

    if (!/^\d+$/.test(length)) {
        document.getElementById('lengthError').textContent = "La longueur doit être un entier en cm.";
        valid = false;
    }

    if (!/^\d+$/.test(deepness)) {
        document.getElementById('deepnessError').textContent = "La profondeur doit être un entier en cm.";
        valid = false;
    }

    const validFloorsNDC = ['-1', '0', '1', '2', '3', '4', '5', '6'];
    const validFloorsNDL = ['-1', '0', '1', '2', '3', '4'];

    if (campus === "NDC" && !validFloorsNDC.includes(floor)) {
        document.getElementById('floorError').textContent = "L'étage doit être compris entre -1 et 6 pour NDC.";
        valid = false;
    }

    if (campus === "NDL" && !validFloorsNDL.includes(floor)) {
        document.getElementById('floorError').textContent = "L'étage doit être compris entre -1 et 4 pour NDL.";
        valid = false;
    }


    // Validation for floor: integer between -1 and 6, or "sous sol"
    if (!/^(-1|0|1|2|3|4|5|6|sous sol)$/.test(floor)) {
        document.getElementById('floorError').textContent = "L'étage doit être compris entre -1 et 6 ou 'sous sol'.";
        valid = false;
    }

    // Validation for description: alphanumeric, 3 to 50 characters
    if (description != "" && !/^[a-zA-Z0-9\s]{3,50}$/.test(description)) {
        document.getElementById('descriptionError').textContent = "La description doit être alphanumérique et contenir entre 3 et 50 caractères.";
        valid = false;
    }

    return valid;
}

function updateFloorOptions() {
    const campus = document.getElementById('campus').value;
    const floorSelect = document.getElementById('floor');

    // Clear existing options
    floorSelect.innerHTML = '<option value="">Sélectionnez un étage</option>';

    if (campus === "NDC") {
        for (let i = -1; i <= 6; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i === -1 ? "Sous sol" : i;
            floorSelect.appendChild(option);
        }
    } else if (campus === "NDL") {
        for (let i = -1; i <= 4; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i === -1 ? "Sous sol" : i;
            floorSelect.appendChild(option);
        }
    }
}