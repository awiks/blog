<div class="card shadow mb-4">
  <div class="card-header py-2">
        <h6 class="m-0 font-weight-bold text-primary py-2 float-left">Data Artikel
        	<span class="badge badge-danger"><?= $total_artikel ?></span>
        </h6>

        <a href="<?= base_url('cpanel/pages/artikel/create')?>" class="btn bg-maroon btn-icon-split float-right">
            <span class="icon text-white-50">
                <i class="fas fa-plus-circle"></i>
            </span>
            <span class="text">Add data</span>
        </a>

    </div>
    <div class="card-body">

    	<?php if(count($result) > 0 ){ ?>
    		<div class="row blog">

    			<?php foreach ( $result as $key => $item): ?>
    				
    				<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 pl-2 pr-2">
    					<div class="card mb-3 elevation-1 bg-gray-100">
    						<img src="<?= base_url('storage/300/'.$item->images.'') ?>" 
    						     class="card-img-top article-thumbnail" 
    						     width="100%">

    						<div class="card-body">
		                        <h5 class="card-title text-primary"><?= $item->categorys_name ?></h5>
		                      <p class="card-text"><?= character_limiter($item->title,25) ?></p>
		                      <div class="d-flex justify-content-between align-items-center">
		                        <div class="btn-group">
		                          <a href="<?= base_url('/cpanel/pages/artikel/show/' . $item->random_id . '') ?>" class="btn btn-sm btn-outline-secondary">View</a>
		                          <a href="<?= base_url('cpanel/pages/artikel/edit/'.$item->random_id.'') ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
		                          <a href="#Modal-del" data-toggle="modal" id="<?=$item->id?>" class="btn btn-sm btn-outline-secondary delete">Delete</a>
		                        </div>
		                      </div> 
		                     
		                    </div>

		                    <div class="ribbon-wrapper">
		                      <?php if( $item->status_publish===0 ): ?>
		                      <div class="ribbon bg-danger">
		                        Pending
		                      </div>
		                      <?php else: ?>
		                      <div class="ribbon bg-success">
		                        Publish
		                      </div>
		                      <?php endif ?>
		                    </div>

    					</div>
    				</div>
    			
    			<?php endforeach; ?>

    		</div>

    		<nav class="mt-2 pagination justify-content-center"><?= $pagination; ?></nav>

    	<?php }else{ ?>
    		<h5>Data masih kosong</h5>
    	<?php } ?>

    </div>
</div>