<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
</head>
<body>
@if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif
    <form action="/Employe/add" method="post">
        @csrf
        <label for="ID_NIN">ID NIN:</label>
        <input type="text" id="ID_NIN" name="ID_NIN"><br><br>

        <label for="ID_P">ID P:</label>
        <input type="number" id="ID_P" name="ID_P"><br><br>

        <label for="Nom_P">Nom:</label>
        <input type="text" id="Nom_P" name="Nom_P"><br><br>

        <label for="Prenom_O">Prenom:</label>
        <input type="text" id="Prenom_O" name="Prenom_O"><br><br>

        <label for="Date_Nais_P">Date of Birth:</label>
        <input type="date" id="Date_Nais_P" name="Date_Nais_P"><br><br>

        <label for="Lieu_N">Lieu de Naissance:</label>
        <input type="text" id="Lieu_N" name="Lieu_N"><br><br>

        <label for="Address">Address:</label>
        <input type="text" id="Address" name="Address"><br><br>

        <input type="submit" value="Add Employee">
    </form>
</body>
</html>