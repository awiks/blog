<div class="card">
	<div class="card-body">
		<div class="post">
			<h4># <?= $show->title ?></h4>
			<div class="user-block">
              <img class="img-circle img-bordered-sm" 
                   src="<?= base_url('asset/backend/vendor/dist/img/avatar5.png') ?>" 
                   alt="user image">
	            <span class="username">
	              <a href="#"><?= $show->name ?></a>
	            </span>
	            <?php
	            if( $show->status_publish === '1' ){
	            	$status_publish ='Shared publicly';
	            }
	            else{
	            	$status_publish = 'Not Shared';
	            }
	            ?>

               <span class="description">
               	 <?= $status_publish ?> - <?= date('d M Y H:i:s',strtotime($show->created_at)) ?>
               	 - Kategori : <?= $show->categorys_name ?>
               </span>
          </div>

			<p class="card-text"><?= $show->content ?></p>
			<p>Tags : 

			 <?php foreach ($tags as $key => $value): ?>
             
             <span class="badge badge-warning p-2 badge-pill">
             	#<?= $value->tags_name ?>
             </span>

             <?php endforeach; ?>
			</p>
		</div>
	</div>
	<div class="card-footer">
		<a href="<?= base_url('cpanel/pages/artikel') ?>" class="btn btn-info btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-history"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
	</div>
</div>