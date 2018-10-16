	<!-- Okno formularza zażywania nowego leku -->
  
<div id="formTakeDrug" title="Zażyj lek">
  <p class="validateTips">Wszystkie pola są wymagane!</p>
 
  <form id="formTakeDrugf" action="../db_tools/handle_addDrugIntake.php" method="POST" >
    <fieldset>
      <label for="name">Nazwa leku</label>
      <input type="text" disabled name="f1_drugName" id="f1_drugName" class="text ui-widget-content ui-corner-all" onblur="validate('f1_drugName', 'drugName_Tips')">
      <div id="f1_drugName_Tips"> &nbsp; </div>
      
      <label for="drugsUsed">Liczba zażywanych tabletek</label>
      <input type="number" autocomplete="off" name="f1_noTabletsUsed" id="f1_noTabletsUsed" class="text ui-widget-content ui-corner-all" onKeyUp="validateNoTablets('f1_noTabletsUsed', 'f1_noTabletsUsed_Tips', '2')">
      <div id="f1_noTabletsUsed_Tips"> &nbsp; </div>
      
      <label for="dateUsed">Data/godzina zażycia leku</label>
      <input type="datetime-local" name="dateUsed" id="f1_dateUsed" class="text ui-widget-content ui-corner-all" onchange="validateDate('f1_dateUsed', 'f1_dateUsed_Tips', 2)">
      <div id="f1_dateUsed_Tips"> &nbsp; </div>

		<input type="text" style="display:none" name="f1_id" id="f1_id" class="text ui-widget-content ui-corner-all">
		<input type="text" style="display:none" name="f1_tabCurrent" id="f1_tabCurrent" class="text ui-widget-content ui-corner-all">
		<input type="text" style="display:none" name="f1_tabMax" id="f1_tabMax" class="text ui-widget-content ui-corner-all">

      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
