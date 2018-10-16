	<!-- Okno formularza usuwania leku -->
  
<div id="divRemoveDrug" title="Czy na pewno chcesz usunąć?">
 
  <form id="formRemoveDrug"action="../db_tools/handle_removeDrug.php" method="POST" >
    <fieldset>
      <label id="labelRemoveDrug" for="textArea">Nazwa leku/-ów</label>
      
      
      <textarea disabled id="textArea" rows="8" cols="50"></textarea>
      
      <input type="text"  style="display:none" name="f2_id" id="f2_id" class="text ui-widget-content ui-corner-all">

      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
