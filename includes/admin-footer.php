<?php

/**
 * Admin-specific footer inclusion
 * This file contains only the necessary scripts and closing tags for the admin layout,
 * without the visual footer element.
 */
?>
</div> <!-- End Container -->

<?php if (isLoggedIn() && isAdmin()): ?>
    </div> <!-- End Admin Main Content -->
<?php endif; ?>

<!-- Custom JS -->
<script src="<?php echo base_url('assets/js/validation.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/script.js'); ?>"></script>
</body>

</html>