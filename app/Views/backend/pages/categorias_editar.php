 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Editar Categorias</h1>

     <!--PHP status msg-->
     <?php if ($msg) : ?>
         <div class="p-3 my-3 alert-info">
             <?= $msg ?>
         </div>
     <?php endif; ?>
     <!--Fim PHP status msg-->

     <div class="p-3 my-3 text-danger">
         <?= \Config\Services::validation()->listErrors(); ?>
     </div>

     <div class="row">
         <div class="col-md-12">
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary">Editar Categorias</h6>
                 </div>
                 <div class="card-body">
                     <form action="<?= base_url('admin/categorias/gravar') ?>" method="post">

                         <div class="form-group">
                             <label for="titulo">Titulo</label>
                             <input class="form-control" type="input" name="titulo" value="<?=$categorias['titulo']?>"/>
                         </div>

                         <div class="form-group">
                             <label for="resumo">Resumo</label>
                             <input class="form-control" type="input" name="resumo" value="<?=$categorias['resumo']?>"/>
                         </div>
                         <input type="hidden" value="<?=$categorias['id']?>" name="id">

                         <?= csrf_field(); ?>

                         <input type="submit" name="submit" class="btn btn-primary" value="Editar" />
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>