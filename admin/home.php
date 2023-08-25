<!DOCTYPE html>
<html>

<head>
  <title>Selamat Datang Administrator</title>
  <!-- Add your CSS links here if needed -->
  <style>
    /* Add your custom CSS styles here if needed */
  </style>
</head>

<body>
  <h2>Selamat Datang Administrator</h2>
  <!-- <pre><?php print_r($_SESSION['admin']); ?></pre> -->
  <form method="post">
    <div class="form-group">
      <label for="perum">Pilih Lokasi</label>
      <select class="form-control" name="perum" id="perum">
        <option value="">Pilih Lokasi</option>
        <?php
        // Assuming you have initialized the $koneksi variable for database connection
        $ambil = $koneksi->query("SELECT * FROM nama_perum");
        while ($loc = $ambil->fetch_assoc()) {
        ?>
          <option value="<?php echo $loc['id_perum']; ?>">
            <?php echo $loc['nama_perum']; ?>
          </option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label for="Latitude">Latitude</label>
      <input name="Latitude" id="Latitude" type="text" class="form-control">
    </div>
    <div class="form-group">
      <label for="Longitude">Longitude</label>
      <input name="Longitude" id="Longitude" type="text" class="form-control">
    </div>
    <div class="form-group">
      <button type="button" onclick="getLocation()" class="btn btn-primary" name="check_lokasi">Check Lokasi</button>
      <!-- Add the button to open location on Google Maps -->
      <button type="button" onclick="openLocationOnGoogleMaps()" class="btn btn-primary" name="open_google_maps">Open on Google Maps</button>
      <button class="btn btn-primary" name="lokasi">Update Lokasi</button>
    </div>
  </form>

  <?php
  if (isset($_POST['lokasi'])) {
    $koneksi->query("INSERT INTO lokasi
		(id_perum,latitude,longitude)
		VALUES ('$_POST[perum]','$_POST[Latitude]','$_POST[Longitude]')");
    echo "<script>alert('Lokasi Berhasil Terupdate');</script>";
    echo "<meta http-equiv='refresh' content='1;url=index.php'>";
  }
  ?>

  <div id="map" style="height: 400px;"></div>
  <script>
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        document.getElementById("demo").innerHTML = "Geolocation is not supported by this browser.";
      }
    }

    function showPosition(position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
      var mapOptions = {
        center: {
          lat: latitude,
          lng: longitude
        },
        zoom: 14
      };
      var map = new google.maps.Map(document.getElementById("map"), mapOptions);
      var marker = new google.maps.Marker({
        position: {
          lat: latitude,
          lng: longitude
        },
        map: map
      });
      document.getElementById("Latitude").value = latitude;
      document.getElementById("Longitude").value = longitude;
    }

    function openLocationOnGoogleMaps() {
      var latitude = document.getElementById("Latitude").value;
      var longitude = document.getElementById("Longitude").value;
      var url = "https://www.google.com/maps/search/?api=1&query=" + latitude + "," + longitude;
      window.open(url, "_blank");
    }
  </script>
  <!-- Add your other JavaScript scripts here if needed -->
  <!-- Make sure to replace YOUR_GOOGLE_MAPS_API_KEY with your actual API key -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDy8lalbliWCHFvDkEQeXHR26NPsMO3E7k&callback=initMap" async defer></script>
</body>

</html>