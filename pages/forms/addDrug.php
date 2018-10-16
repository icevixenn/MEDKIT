	<!-- Okno formularza dodawania nowego leku -->
  
<div id="divAddPackage" title="Dodaj nowe opakowanie leku">
  <p class="validateTips">Wszystkie pola są wymagane!</p>
 
  <form id ="formAddPackage" action="../db_tools/handle_addPackage.php" method="POST" >
    <fieldset>
      <label for="name">Nazwa leku</label>
      <input type="text" name="drugName" id="drugName" class="text ui-widget-content ui-corner-all" onKeyUp="return validateDrugName('drugName', 'drugName_Tips')" onBlur="return validateDrugName('drugName', 'drugName_Tips')" >
      <div id="drugName_Tips"> &nbsp; </div>
      
      <label for="noTablets_max">Liczba tabletek w opakowaniu</label>
      <input type="text" autocomplete="off" name="noTablets_max" id="noTablets_max" class="text ui-widget-content ui-corner-all" onKeyUp="validateNoTablets('noTablets_max', 'noTablets_max_Tips', '1')">
      <div id="noTablets_max_Tips"> &nbsp; </div>
      
      <label for="dateExpiry">Data ważnosci leku</label>
      <input type="date" name="dateExpiry" id="dateExpiry" class="text ui-widget-content ui-corner-all" onchange="validateDate('dateExpiry', 'dateExpiry_Tips', 1)">
      <div id="dateExpiry_Tips"> &nbsp; </div>
      
      <label for="price">Cena</label>
      <input type="text" name="price" autocomplete="off" id="price" class="text ui-widget-content ui-corner-all" onKeyUp="validatePrice('price', 'price_Tips')">
 	  <div id="price_Tips"> &nbsp; </div>
 	
	

 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>