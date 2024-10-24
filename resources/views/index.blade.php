<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Metriskās sistēmas Konvertētājs</title>
</head>
<body>
    <style>
body {
    background-image: url('https://cdn.discordapp.com/attachments/1252921810148786208/1252943458566672426/output-onlinepngtools_1.png?ex=66740e07&is=6672bc87&hm=29d4c7cbc06c05f46346b79c2c419846744f660ce447b6611cb83ff7d5180a96&');
    background-size: cover;
    background-position: center;
    background-blend-mode:lighten;
    font-family: 'Arial', sans-serif;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    position: relative; 
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.5);
}

.container {
    display: inline-block;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    z-index: 1; /* Ensure content is above the overlay */
}

.checkbox-group {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.checkbox-group label {
    margin-right: 10px;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

button {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #45a049;
}

.error {
    font-size: 1.5em;
    color: red;
    text-align: center;
    margin-top: 20px;
}
    </style>
<div class="container">
    <h1>Metriskās sistēmas Konvertētājs</h1>
    <div class="container">
        <label for="ievade">Ievadiet vērtību:</label>
        <input type="number" id="ievade" step="any" required>

        <label for="kategorija">Mērvienību kategorija:</label>
        <select id="kategorija" onchange="updateUnits()">
            <option value="Garums">Garums</option>
            <option value="Masa">Masa</option>
            <option value="Laiks">Laiks</option>
        </select>

        <label for="ievadvienība">Ievades vienība:</label>
        <select id="ievadvienība"></select>

        <label for="rezultātvienība">Rezultāta vienība:</label>
        <select id="rezultātvienība"></select>

        <button onclick="pārveidot()">Pārveidot</button>

        <div id="rezultāti" class="rezultāti"></div>
        <div id="error" class="error"></div>
    </div>
    <li><a href="https://github.com/rtk2023/riki">Github</a></li>
    <li><a href="https://rtk2023.github.io/riki/">Rīku saraksts</a></li>

    <script>
        const units = {
            "Garums": ["Metri", "Kilometri", "Centimetri", "Jūdzes", "Pēdas"],
            "Masa": ["Kilogrami", "Grami", "Centneri", "Tonnas", "Mārciņas"],
            "Laiks": ["Sekundes", "Minūtes", "Stundas", "Diennaktis"]
        };

        function updateUnits() {
            const kategorija = document.getElementById('kategorija').value;
            const ievadvienība = document.getElementById('ievadvienība');
            const rezultātvienība = document.getElementById('rezultātvienība');

            ievadvienība.innerHTML = '';
            rezultātvienība.innerHTML = '';

            units[kategorija].forEach(unit => {
                const ievadOption = document.createElement('option');
                ievadOption.value = unit;
                ievadOption.textContent = unit;
                ievadvienība.appendChild(ievadOption);

                const rezultātOption = document.createElement('option');
                rezultātOption.value = unit;
                rezultātOption.textContent = unit;
                rezultātvienība.appendChild(rezultātOption);
            });
        }

        document.addEventListener("DOMContentLoaded", updateUnits);

        function pārveidot() {
            const ievade = parseFloat(document.getElementById('ievade').value);
            const ievadvienība = document.getElementById('ievadvienība').value;
            const rezultātvienība = document.getElementById('rezultātvienība').value;

            const konvertēšanasKoeficienti = {
                "Metri": {
                    "Centimetri": 100,
                    "Kilometri": 0.001,
                    "Jūdzes": 0.000621371,
                    "Pēdas": 3.28084
                },
                "Centimetri": {
                    "Metri": 0.01,
                    "Kilometri": 0.00001,
                    "Jūdzes": 0.00000621371,
                    "Pēdas": 0.0328084
                },
                "Kilometri": {
                    "Metri": 1000,
                    "Centimetri": 100000,
                    "Jūdzes": 0.621371,
                    "Pēdas": 3280.84
                },
                "Jūdzes": {
                    "Metri": 1609.34,
                    "Centimetri": 160934,
                    "Kilometri": 1.60934,
                    "Pēdas": 5280
                },
                "Pēdas": {
                    "Metri": 0.3048,
                    "Centimetri": 30.48,
                    "Kilometri": 0.0003048,
                    "Jūdzes": 0.000189394
                },
                "Kilogrami":{
                    "Grami": 1000,
                    "Tonnas": 0.001,
                    "Centneri": 0.01,
                    "Mārciņas": 2.2046
                },
                "Grami":{
                    "Kilogrami": 0.001,
                    "Tonnas": 0.000001,
                    "Centneri": 0.00001,
                    "Mārciņas": 0.0022
                },
                "Tonnas":{
                    "Kilogrami": 1000,
                    "Centneri": 10,
                    "Grami": 1000000,
                    "Mārciņas": 2204.62
                },
                "Centneri":{
                    "Kilogrami": 100,
                    "Grami": 100000,
                    "Tonnas": 0.1,
                    "Mārciņas": 220.46
                },
                "Mārciņas":{
                    "Kilogrami":0.4536,
                    "Grami":453.59,
                    "Centneri":45.356,
                    "Tonnas": 0.00045
                },
                "Stundas":{
                    "Sekundes":3600,
                    "Minūtes":60,
                    "Diennaktis": 0.0416666667
                },
                "Minūtes":{
                    "Sekundes":60,
                    "Stundas":0.0166666667,
                    "Diennaktis": 0.0006944444
                },
                "Diennaktis":{
                    "Sekundes": 86400,
                    "Stundas": 24,
                    "Minūtes": 1440
                },
                "Sekundes":{
                    "Stundas":0.0002777778,
                    "Minūtes":0.0166666667,
                    "Diennaktis":0.0000115741
                }
            };

            const errorDiv = document.getElementById('error');
            errorDiv.innerHTML = '';

            if (isNaN(ievade) || ievade <= 0) {
                showError("Ievadiet pozitīvu skaitlisku vērtību!");
                return;
            }

            if (ievadvienība === rezultātvienība) {
                showError("Ievades vienība un rezultāta vienība nevar būt vienādas!");
                return;
            }

            const rezultāts = ievade * konvertēšanasKoeficienti[ievadvienība][rezultātvienība];

            const rezultāti = document.getElementById('rezultāti');
            rezultāti.innerHTML = '';

            const rezultātuRinda = document.createElement('div');
            rezultātuRinda.classList.add('rezultātu-rindas');

            const rezultātuNosaukums = document.createElement('span');
            rezultātuNosaukums.classList.add('rezultātu-nosaukums');
            rezultātuNosaukums.textContent = rezultātvienība + ":";

            const rezultātuVērtība = document.createElement('span');
            rezultātuVērtība.classList.add('rezultātu-vērtība');
            rezultātuVērtība.textContent = rezultāts;

            rezultātuRinda.appendChild(rezultātuNosaukums);
            rezultātuRinda.appendChild(rezultātuVērtība);

            rezultāti.appendChild(rezultātuRinda);
        }

        function showError(message) {
            const errorDiv = document.getElementById('error');
            const errorMessage = document.createElement('p');
            errorMessage.textContent = message;

            const errorLink = document.createElement('a');
            errorLink.href = 'https://example.com';
            errorLink.target = '_blank';

            const errorImage = document.createElement('img');
            errorImage.src = 'https://pbs.twimg.com/media/Eq-SWUcWMAEDesC?format=jpg&name=medium';
            errorImage.alt = 'Error';

            errorLink.appendChild(errorImage);

            errorDiv.appendChild(errorMessage);
            errorDiv.appendChild(errorLink);
        }
    </script>
</div>
</body>
</html>