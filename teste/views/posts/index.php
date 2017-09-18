<p>Here is a list of all posts:</p>

<?php foreach($posts as $post) { ?>
  <p>
    <?php echo $post->nm_usuario; ?>
    <a href='?controller=posts&action=show&id_usuario=<?php echo $post->id_usuario; ?>'>See content</a>
  </p>
<?php } ?>