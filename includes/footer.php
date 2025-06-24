</main>

<!-- Popup de confirmation de déconnexion -->
<div id="logoutPopup" style="
  display: none;
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.6);
  z-index: 1000;
  justify-content: center;
  align-items: center;
">
  <div style="
    background: white;
    padding: 30px;
    border-radius: 10px;
    max-width: 400px;
    text-align: center;
    box-shadow: 0 0 20px rgba(0,0,0,0.3);
  ">
    <p style="font-size: 18px; margin-bottom: 25px;">
      ⚠️ Voulez-vous vraiment vous déconnecter ?
    </p>
    <div style="display: flex; justify-content: center; gap: 15px;">
      <button id="confirmLogout" style="
        width: 150px;
        padding: 10px;
        background-color: #e74c3c;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      ">
        Oui
      </button>
      <button id="cancelLogout" style="
        width: 150px;
        padding: 10px;
        background-color: #2ecc71;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      ">
        Non
      </button>
    </div>
  </div>
</div>


<script>
  const logoutBtn = document.getElementById('logoutBtn');
  const popup = document.getElementById('logoutPopup');
  const confirmLogout = document.getElementById('confirmLogout');
  const cancelLogout = document.getElementById('cancelLogout');

  logoutBtn.addEventListener('click', function(e) {
    e.preventDefault();
    popup.classList.remove('hide');
    popup.style.display = 'flex';
  });

  confirmLogout.addEventListener('click', function() {
    window.location.href = "logout.php";
  });

  cancelLogout.addEventListener('click', function() {
    popup.classList.add('hide');
    setTimeout(() => {
      popup.style.display = 'none';
      popup.classList.remove('hide');
    }, 300); // 300ms = durée de l'animation
  });
</script>


    <hr>
    <footer style=" position: sticky;  width: 100%;  bottom: 0;">
        <p>&copy; <?= date('Y') ?> Plateforme de Tontines IDA P9. Tous droits réservés.</p>
    </footer>
</body>
</html>


