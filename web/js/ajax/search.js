$(document).ready(function()
{
  $('.search input[type="submit"]').hide();
 
  $('#search_keywords').keyup(function(key)
  {
    if (this.value.length >= 3)
    {
      $('#result').load(
        $(this).parents('form').attr('action'),
        { query: this.value },
        function() {}
      );
          $('#result').show();
    }
        if (this.value.length < 3)
    {
      $('#result').load(
        $(this).parents('form').attr('action'),
        { query: this.value },
        function() {}
      );
          $('#result').hide();
    }
  });
});

