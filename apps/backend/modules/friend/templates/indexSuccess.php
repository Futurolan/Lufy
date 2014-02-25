<h1>Friends List</h1>

<table>
  <thead>
    <tr>
      <th>User</th>
      <th>Friend</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($friends as $friend): ?>
    <tr>
      <td><a href="<?php echo url_for('friend/edit?user_id='.$friend->getUserId().'&friend_id='.$friend->getFriendId()) ?>"><?php echo $friend->getUserId() ?></a></td>
      <td><a href="<?php echo url_for('friend/edit?user_id='.$friend->getUserId().'&friend_id='.$friend->getFriendId()) ?>"><?php echo $friend->getFriendId() ?></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('friend/new') ?>" class="btn btn-default">New</a>
