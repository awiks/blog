<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('/')?>"><i class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Contact</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="mb-5 pb-5">
    <div class="container">

        <?= $this->session->flashdata('messages') ?>
        <?= validation_errors(); ?>

        <form action="<?= base_url('contact') ?>" method="post">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contact Form</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" value="<?= set_value('name'); ?>" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" value="<?= set_value('email'); ?>" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" value="<?= set_value('phone'); ?>" name="phone" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Pesan</label>
                    <textarea rows="5" name="message" class="form-control" required><?= set_value('message'); ?></textarea>
                </div>

                <div class="form-group">
                  <?= $captcha ?>
                </div>

                <div class="form-group">

                  <input type="text" 
                         placeholder="masukan kode CAPTCHA diatas"
                         name="capcha" 
                         class="form-control" required>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Kirim pesan</button>
            </div>
        </div>
        </form>
    </div>
</section>