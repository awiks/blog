<div class="card shadow mb-4">
    <div class="card-header py-2">
        <h6 class="m-0 font-weight-bold text-primary py-2 float-left">Add About</h6>

        <a href="<?= base_url('cpanel/pages/about') ?>" class="btn btn-info btn-icon-split float-right">
            <span class="icon text-white-50">
                <i class="fas fa-history"></i>
            </span>
            <span class="text">Kembali</span>
        </a>

    </div>
    <form id="simpan" action="<?= base_url('cpanel/pages/about/perbarui') ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="<?= $edit->slug ?>">
    <div class="card-body">

        <div class="form-group">
            <label>Title</label>
            <input type="text" value="<?= $edit->title ?>" class="form-control" name="title" required>
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
                    <label>Status Publish</label>
                    <select class="form-control" name="status" required>
                        <option value="">-- Pilih --</option>
                        <option value="0" <?php if($edit->status === '0'): echo 'selected'; endif; ?>>Pending</option>
                        <option value="1" <?php if($edit->status === '1'): echo 'selected'; endif; ?>>Publish</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control textarea" name="content" cols="30" rows="10" required><?= $edit->content ?></textarea>
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