<footer>
    <p class="text-center">Done by Didier</p>
</footer>
<script type="text/javascript">
function salir() {
  $.ajax( { type : 'POST',
          data : { },
          url  : 'logoff.php',              // <=== CALL THE PHP FUNCTION HERE.
          success: function () {
            location.href = 'index.php';            // <=== VALUE RETURNED FROM FUNCTION.
          },
          error: function ( xhr ) {
            alert( "error" + xhr);
          }
        });
}
</script>

</body>
<script src = "https://code.jquery.com/jquery-3.2.1.min.js">
</script>
</html>
