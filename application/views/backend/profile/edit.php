<div class="card shadow mb-4">
    <div class="card-header py-2">
        <h6 class="m-0 font-weight-bold text-primary py-2 float-left">Add Profile</h6>

        <a href="<?= base_url('cpanel/profile') ?>" class="btn btn-info btn-icon-split float-right">
            <span class="icon text-white-50">
                <i class="fas fa-history"></i>
            </span>
            <span class="text">Kembali</span>
        </a>

    </div>

    <form id="simpan" action="<?= base_url('cpanel/profile/perbarui') ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="<?= $edit->slug ?>">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Author</label>
                        <select class="form-control" disabled>
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
            </div>
            
            <div class="form-group">
                <label>About</label>
                <textarea class="form-control textarea" name="about" cols="30" rows="10" required><?= $edit->about ?></textarea>
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