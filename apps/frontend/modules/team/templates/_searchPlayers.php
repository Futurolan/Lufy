<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>
<h2><?php echo __('Rechercher des joueurs pour mon équipe')?></h2>
<form action="<?php //echo url_for('team/addMember) ?>" method="get">
  <input type="text" id="query" name="query" value="<?php echo $sf_request->getParameter('query') ?>" />
  <input type="submit" value="search" />
</form>

<div id="results"></div>

<script>
$(document).ready(function() {
  var url_add_member = "<?php echo url_for('team/inviteMember?team_id='.$team->getIdTeam().'&user_id='); ?>";
  $('#query').keyup(function (){
    if ($('#query').val().length >2){
      $.get(
        '',
        {'query': $('#query').val()},
        function(data) {
          var obj = $.parseJSON(data);
          $('#results').html('');
          $.each(obj,function(index, value){
            $('#results').html($('#results').html()+'<li>'+value.username+' <a class="icon-plus btn btn-success btn-mini" href="'+url_add_member+value.id+'"></a></li>');
          });
          $('#results').html('<ul>'+$('#results').html()+'</ul>');
        }
      );
    }
   });
});
</script>