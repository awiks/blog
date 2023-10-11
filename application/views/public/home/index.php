<section class="jumbotron bg-info text-white">
  <div class="container my-5">
     <h1>Catatan Koding</h1>
     <p class="lead">Setiap catatan adalah pengingat saat dibutuhkan</p>

     <a class="btn btn-danger shadow" href="<?= base_url('category') ?>">
       Lihat Catatan disini
     </a>

  </div>
</section>

 <section class="blog-content-area">
  <div class="container">
    <div class="row justify-content-center">

     <div class=" col-lg-3 col-md-12 col-sm-12 col-xs-12 pl-2 pr-2"></div>
     <div class=" col-lg-6 col-md-12 col-sm-12 col-xs-12 pl-2 pr-2">
       
       <div class="card box-shadow mb-4">
          <div class="card-body">
            <h3 class="mb-3">Cari catatan koding lainnya :</h3>
        
              <form action="<?= base_url('/key')?>" method="get">
             
              <div class="input-group input-group-lg">
                <input type="text" name="search" class="form-control" placeholder="ketik disini">
                <div class="input-group-prepend">

                  <button class="btn btn-primary rounded-right" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                 
                </div>
              </div>
              </form>
          </div>
        </div>

     </div>
     <div class=" col-lg-3 col-md-12 col-sm-12 col-xs-12 pl-2 pr-2"></div>
    </div>
    
      
    <div class="row justify-content-center load" style="display:none">
      <div class="col-3 text-center">
        <button type="button" class="btn btn-block btn-outline-primary btn-md">
          <i class="fa fa-spinner fa-spin default"></i> Loading
        </button>
      </div>
    </div>

      
    <div id="post_data"></div>
 
    </div>
</section>

<section class="jumbotron bg-white">
  <div class="text-center mb-5">
    <h2>Artikel berdasarkan Kategori</h2>
    <p class="lead">Baca artikel yang sesuai dengan minat kamu.</p>
  </div>

<div class="container">
  <div class="row">
    <?php foreach ($kategory as $key => $item): ?>
    <?php
    $id     = $item->id;
    $query  = $this->db->query("SELECT a.title,a.slug AS slug_a,c.slug AS slug_c 
                                FROM articles a
                                JOIN categories c ON a.category_id=c.id 
                                WHERE category_id='$id'
                                ORDER BY a.created_at DESC LIMIT 0,5");
    $result = $query->result();
    ?>

    <div class="col-12 col-md-6 col-lg-4 mb-4 border-0">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title mt-2"><?= $item->categorys_name ?></h3>
        </div>
        <div class="card-body p-0 flat">
          <ul class="list-group list-group-flush">
          <?php foreach ( $result as $key => $val): ?>
            <li class="list-group-item">
              <a href="<?= base_url('articles/'.$val->slug_c.'/'.$val->slug_a.'') ?>" class=""><?= $val->title ?></a>
            </li>
          <?php endforeach; ?>
          </ul>
        </div>
        <div class="card-footer">
          <a href="<?= base_url('articles/category/'.$item->slug_c.'') ?>">Lihat Semua <i class="fas fa-long-arrow-alt-right"></i></a>
        </div>
      </div>
    </div>

  <?php endforeach; ?>

  </div>
</div>
</section>