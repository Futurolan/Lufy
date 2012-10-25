function kfm_for_tiny_mce(field_name, url, type, win){
  window.SetUrl=function(url,width,height,caption){
   win.document.forms[0].elements[field_name].value = url;
   if(caption){
    win.document.forms[0].elements["alt"].value=caption;
    win.document.forms[0].elements["title"].value=caption;
   }
  }
  window.open('../../../kfm/index.php?mode=selector&type='+type,'kfm','modal,width=800,height=600');
}
