 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Notícias</h1>

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
                     <h6 class="m-0 font-weight-bold text-primary">Inserir notícias</h6>
                 </div>
                 <div class="card-body">

                     <form action="<?= base_url('admin/noticias/gravar') ?>" method="post" enctype="multipart/form-data">
                         <div class="form-group">
                             <div class="checkbox">
                                 <label>
                                     <input type="checkbox" name="destaque" class="form-check-label" value="1"> Notícia de destaque?
                                 </label>
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="titulo">Titulo</label>
                             <input class="form-control" type="input" name="titulo" />
                         </div>
                         <div class="form-group">
                             <label for="categoria">Categoria</label>
                             <select name="categoria" class="form-control" tabindex="-1">
                                 <option value="">Escolha a categoria</option>
                                 <?php foreach ($categorias as $categoria_item) : ?>
                                     <option value="<?= $categoria_item['id'] ?>"><?= $categoria_item['titulo'] ?></option>
                                 <?php endforeach; ?>
                             </select>
                         </div>
                         <div class="form-group">
                             <label for="resumo">Resumo</label>
                             <input class="form-control" type="input" name="resumo" />
                         </div>

                         <div class="form-group">
                             <label for="conteudo">Conteúdo</label>
                             <textarea name="conteudo" class="form-control" rows="10"></textarea>
                         </div>
                         <div class="form-group">
                             <label for="img">Imagem</label>
                             <input type="file" name="img" />
                         </div>
                         <input type="hidden" value="" name="id">
                         <?= csrf_field(); ?>

                         <input type="submit" name="submit" class="btn btn-primary" value="Inserir" />
                     </form>
                 </div>
             </div>
         </div>

         <div class="col-md-12">
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary">Notícias Cadastradas</h6>
                 </div>
                 <div class="card-body">
                     <table class="table table-bordered dataTable table-striped" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                         <thead>
                             <tr role="row">
                                 <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Imagem</th>
                                 <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Noticia</th>
                                 <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Data</th>
                                 <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Destaque</th>
                                 <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Alterar</th>
                                 <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Excluir</th>
                             </tr>
                         </thead>

                         <!-- PHP Exibindo as noticias cadastradas -->
                         <tbody>
                             <?php foreach ($noticias as $noticia_item) : ?>
                                 <tr role="row" class="odd">
                                     <td>
                                         <?php if ($noticia_item['img']) : ?>
                                             <img src="/img/noticias/<?= $noticia_item['id'] ?>" alt="" style="width: 100px">
                                         <?php else : ?>
                                             <img src="/img/semfoto.png" alt="" style="width: 100px">
                                         <?php endif; ?>
                                     </td>
                                     <td><?= $noticia_item['titulo'] ?></td>
                                     <td><?= date("d-m-Y H:i", strtotime($noticia_item['created_at'])); ?></td>
                                     <td>
                                         <?php if ($noticia_item['destaque'] == 1) : ?>
                                             <span class="text-success">SIM</span>
                                         <?php else : ?>
                                             <span class="text-danger">NÃO</span>
                                         <?php endif; ?>
                                     </td>
                                     <td><a href="/admin/noticias/editar/<?= $noticia_item['id'] ?>"><i class="fas fa-edit"></i>Alterar</a></td>
                                     <td><a href="/admin/noticias/excluir/<?= $noticia_item['id'] ?>" onclick="return confirm('Deseja mesmo excluir a notícia <?= $noticia_item['titulo'] ?>?');"><i class="fas fa-trash"></i> Excluir</a></td>
                                 </tr>
                             <?php endforeach; ?>
                         </tbody>
                         <!-- Fim PHP Exibindo as noticias cadastradas -->
                     </table>
                     <?= $pager->links(); ?>
                 </div>
             </div>
         </div>
     </div>
     <script src="/js/tinymce/tinymce.min.js"></script>
     <script>
         tinymce.init({
             language: 'pt_BR',
             selector: 'textarea',
             theme: 'modern',
             plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount   imagetools contextmenu colorpicker textpattern code',
             toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat code',
             image_advtab: true,
             templates: [{
                     title: 'Test template 1',
                     content: 'Test 1'
                 },
                 {
                     title: 'Test template 2',
                     content: 'Test 2'
                 }
             ],
             content_css: [
                 '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                 '//www.tinymce.com/css/codepen.min.css'
             ]
         });
     </script>