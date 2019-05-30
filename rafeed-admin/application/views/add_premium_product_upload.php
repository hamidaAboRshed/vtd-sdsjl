<div id="_upload">
    <?php foreach ($AttachmentType as $rec) : ?>
        <div class="form-group">
            <p class="form_title">upload <?php echo $rec['Name']; ?></p><br/>
            <input type="file" name="FileName[]"/>
            <input type="hidden" name="AttachmentTypeID[]" value="<?php echo $rec['ID']; ?>">
        </div>
    <?php endforeach; ?>
</div>