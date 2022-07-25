 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Editar Noticia</h1>

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
                     <h6 class="m-0 font-weight-bold text-primary">Editar Noticia</h6>
                 </div>
                 <div class="card-body">
                     <form action="<?= base_url('admin/noticias/gravar') ?>" method="post" enctype="multipart/form-data">

                         <div class="form-group">
                             <div class="checkbox">
                                 <label>
                                     <input type="checkbox" name="destaque" class="form-check-label" value="1" <?php if ($noticias['destaque'] == 1) {
                                                                                                                    echo 'checked';
                                                                                                                } ?>> Notícia de destaque?
                                 </label>
                             </div>
                         </div>

                         <div class="form-group">
                             <label for="categoria">Categoria</label>
                             <select name="categoria" class="form-control" tabindex="-1">
                                 <option value="">Escolha a categoria</option>
                                 <?php foreach ($categorias as $categoria_item) : ?>
                                     <option value="<?= $categoria_item['id'] ?>" <?php if ($categoria_item['id'] == $noticias['cat']) {
                                                                                        echo 'selected';
                                                                                    } ?>> <?= $categoria_item['titulo'] ?></option>
                                 <?php endforeach; ?>
                             </select>
                         </div>



                         <div class="form-group">
                             <label for="titulo">Título</label>
                             <input class="form-control" type="input" name="titulo" value="<?= $noticias['titulo'] ?>" />
                         </div>

                         <div class="form-group">
                             <label for="resumo">Resumo</label>
                             <input class="form-control" type="input" name="resumo" value="<?= $noticias['resumo'] ?>" />
                         </div>

                         <div class="form-group">
                             <label for="conteudo">Conteúdo</label>
                             <textarea name="conteudo" class="form-control" rows="10"><?= $noticias['conteudo'] ?></textarea>
                         </div>
                         <div class="form-group">
                             <label for="img">Imagem</label>
                             <input type="file" name="img" />
                         </div>
                         <input type="hidden" value="<?= $noticias['id'] ?>" name="id">

                         <?= csrf_field(); ?>

                         <input type="submit" name="submit" class="btn btn-primary" value="Editar" />
                     </form>
                 </div>
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