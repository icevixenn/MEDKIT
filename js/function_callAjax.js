  function callAjax(method, value, target)
  {
    if(encodeURIComponent) {
      var req = new AjaxRequest();
      
      var params = "method=" + method + "&value=" + encodeURIComponent(value) + "&target=" + target;
      //var params = "method=checkAge&value=16&target=someid";
      req.setMethod("POST");
      req.loadXMLDoc('../db_tools/validate.php', params);
    }
  }