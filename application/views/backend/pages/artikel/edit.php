<div class="card shadow mb-4">
    <div class="card-header py-2">
        <h6 class="m-0 font-weight-bold text-primary py-2 float-left">Edit Artikel</h6>

        <a href="<?= base_url('cpanel/pages/artikel') ?>" class="btn btn-info btn-icon-split float-right">
            <span class="icon text-white-50">
                <i class="fas fa-history"></i>
            </span>
            <span class="text">Kembali</span>
        </a>

    </div>
    <form id="simpan" action="<?= base_url('cpanel/pages/artikel/perbarui') ?>" method="post" enctype="multipart/form-data">
     <input type="hidden" name="_token" value="<?= $edit->random_id ?>">
    <div class="card-body">

        <div class="alert alert-warning">
          <i class="fas fa-info-circle"></i> Judul artikel tidak boleh sama dengan artikel yang pernah dibuat.!!
        </div>

        <div class="form-group">
            <label>Title</label>
            <input type="text" value="<?= $edit->title ?>" class="form-control" disabled>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Author</label>
                    <select class="form-control" name="user_id" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($users as $item):  ?>
                            <?php
                            if( $edit->user_id === $item->id ):
                                $selected = 'selected';
                            else:
                                $selected = '';
                            endif;
                            ?>
                          <option value="<?= $item->id ?>" <?= $selected ?>><?= $item->name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status Publish</label>
                    <select class="form-control" name="status_publish" required>
                        <option value="">-- Pilih --</option>
                        <option value="0" <?php if($edit->status_publish === '0'): echo 'selected'; endif; ?>>Pending</option>
                        <option value="1" <?php if($edit->status_publish === '1'): echo 'selected'; endif; ?>>Publish</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control" name="category_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($category as $item): ?>
                          <?php
                            if( $edit->category_id === $item->id ):
                                $selected = 'selected';
                            else:
                                $selected = '';
                            endif;
                            ?>
                          <option value="<?= $item->id ?>" <?= $selected ?>><?= $item->categorys_name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Keyword</label>
                    <input type="text" value="<?= $edit->keywords ?>" class="form-control" name="keywords" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Deskripsi</label>
                    <input type="text" value="<?= $edit->description ?>" class="form-control" name="description" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="images">
                          <label class="custom-file-label">
                          Choose file only JPG | PNG | JPEG
                          </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tags <?= count($detail_tags) ?></label>
                    <select class="form-control multiple" name="tag[]" multiple="multiple" required>
                <?php
                $array = array();
                foreach ( $detail_tags as $key => $value ) {
                   $selected_tag[$key] = $value->tag_id;
                }
                ?>
                <?php foreach ( $tag as $item): ?>
                    <?php if (in_array($item->id, $selected_tag)): ?>
                        <option value="<?= $item->id ?>" selected><?= $item->tags_name ?></option>
                    <?php else: ?>
                        <option value="<?= $item->id ?>"><?= $item->tags_name ?></option>
                    <?php endif; ?>
                <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control textarea" name="content" cols="30" rows="10" required><?= $edit->content ?></textarea>
        </div>

        <div class="form-group form-check">
            <input type="hidden" value="0" name="setting_slider">
            <input type="checkbox" name="setting_slider" class="form-check-input" value="1" <?php if($edit->setting_slider=="1"): echo 'checked'; endif; ?> >
            <label class="form-check-label">Buat Slide Show</label>
        </div>
          

    </div>
    <div class="card-footer">
        <a href="javascript:history.go(-1)" class="btn btn-danger">
         <i class="fas fa-history"></i> Kembali
        </a>
        
        <button type="submit" class="btn btn-primary">
         <i class="fas fa-check"></i> Perbarui
        </button>
    </div>
    </form>
</div>