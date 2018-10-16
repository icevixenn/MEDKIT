	<!-- Okno formularza udostępnienia apteczki -->

<div id="divformshareMedKit" title="Udostępnij swoją apteczkę">
  <p class="validateTips">Obecnie udostępniane apteczki:</p><br>
  <?php 
  require_once '../html_tools/produceShares.php';
  wyswietlDzielenieApteczek($_SESSION['email']);?>
  <br><br>
  <form id="formshareMedKit"action="../db_tools/handle_shareMedKit.php" method="POST" >
    <fieldset>
      <label for="emailB">Wpisz e-mail osoby, której chcesz udostępnić apteczkę: </label>
      <input type="text" autocomplete="off" name="emailB" id="emailB" class="text ui-widget-content ui-corner-all">
      
      <label for="lvl">Wybierz poziom udostępnienia: </label>
      <input type="radio" name="lvl" id="lvl" value ="-1" checked> 1 - może przeglądać
      <input type="radio" name="lvl" id="lvl" value ="-2"> 2 - może używać
      <input type="radio" name="lvl" id="lvl" value ="-3"> 3 - może używać i usuwać

      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
