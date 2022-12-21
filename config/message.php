<?php if(isset($_SESSION['error'])): ?>
    <div class="alert bg-danger text-white">
        <strong><?php echo $_SESSION['error'] ?></strong>
    </div>
<?php endif; unset($_SESSION['error'])?>

<?php if(isset($_SESSION['warning'])): ?>
    <div class="alert bg-warning text-white">
        <strong>Warning! <?php echo $_SESSION['warning'] ?></strong>
    </div>
<?php endif; unset($_SESSION['warning'])?>

<?php if(isset($_SESSION['success'])): ?>
    <div class="alert bg-success text-white">
        <strong>Success! <?php echo $_SESSION['success'] ?></strong>
    </div>
<?php endif; unset($_SESSION['success'])?>