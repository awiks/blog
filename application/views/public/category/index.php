<section class="jumbotron">
    <div class="container my-5 text-center">
        <h1>Catatan apa yang ingin kamu pelajari..??</h1>
    </div>
</section>

<section class="blog-content-area pb-5">
   <div class="container my-5">
       <div class="row">
          <?php foreach ($category as $key => $val): ?>
           <div class="col-6 col-md-6 col-lg-3 mb-4">
              <div class="card">
                 <div class="card-body text-center">
                          <a href="<?= base_url('articles/category/'.$val->slug.'') ?>" class="text-dark d-block mb-3">
                              <img src="<?= base_url('storage/'.$val->images.'') ?>" class="w-50">
                          </a>
                          <h2 class="h5">
                              <a href="<?= base_url('articles/category/'.$val->slug.'') ?>" class="text-dark">
                                  <?= $val->categorys_name ?>
                              </a>
                          </h2>
                  </div>
              </div>
           </div>
           <?php endforeach; ?>
       </div>
   </div>
</section>