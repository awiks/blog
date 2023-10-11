<div class="card shadow mb-4">
    <div class="card-header py-2">
        <h6 class="m-0 font-weight-bold text-primary py-2 float-left">Add Artikel</h6>

        <a href="<?= base_url('cpanel/pages/artikel') ?>" class="btn btn-info btn-icon-split float-right">
            <span class="icon text-white-50">
                <i class="fas fa-history"></i>
            </span>
            <span class="text">Kembali</span>
        </a>

    </div>
    <form id="simpan" action="<?= base_url('cpanel/pages/artikel/create') ?>" method="post" enctype="multipart/form-data">
    <div class="card-body">

        <div class="alert alert-warning">
          <i class="fas fa-info-circle"></i> Judul artikel tidak boleh sama dengan artikel yang pernah dibuat.!!
        </div>

        <div class="form-group">
            <label>Title</label>
            <input type="text" value="<?= set_value('title'); ?>" class="form-control" name="title" required>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Author</label>
                    <select class="form-control" name="user_id" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($users as $item):  ?>
                          <option value="<?= $item->id ?>"><?= $item->name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status Publish</label>
                    <select class="form-control" name="status_publish" required>
                        <option value="">-- Pilih --</option>
                        <option value="0">Pending</option>
                        <option value="1">Publish</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control" name="category_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($category as $item): ?>
                          <option value="<?= $item->id ?>"><?= $item->categorys_name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Keyword</label>
                    <input type="text" value="<?= set_value('keywords'); ?>" class="form-control" name="keywords" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Deskripsi</label>
                    <input type="text" value="<?= set_value('description'); ?>" class="form-control" name="description" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="images" required>
                          <label class="custom-file-label">
                          Choose file only JPG | PNG | JPEG
                          </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tags</label>
                    <select class="form-control multiple" name="tag[]" multiple="multiple" required>
                        <?php foreach ( $tag as $item): ?>
                          <option value="<?= $item->id ?>"><?= $item->tags_name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control textarea" name="content" cols="30" rows="10" required><?= set_value('content'); ?></textarea>
        </div>

        <div class="form-group form-check">
            <input type="hidden" value="0" name="setting_slider">
            <input type="checkbox" name="setting_slider" class="form-check-input" value="1" <?= set_checkbox('setting_slider', '1'); ?> >
            <label class="form-check-label">Buat Slide Show</label>
        </div>
          

    </div>
    <div class="card-footer">
        <a href="javascript:history.go(-1)" class="btn btn-danger">
         <i class="fas fa-history"></i> Kembali
        </a>
        
        <button type="submit" class="btn btn-primary">
         <i class="fas fa-check"></i> Simpan
        </button>
    </div>
    </form>
</div>