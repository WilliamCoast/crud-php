<main>  
    


    <h2 class="mt-3">excluir</h2> 

    <form method="post">
        
        <div class="form-group mt-3"> 
         <p> Você deseja realmente excluir a vaga  <strong><?=$obVaga->titulo?></strong> ? </p>

        <div class="form-group mt-3">   
       <section>  
            <a href="index.php">
            <button type="button" class="btn btn-success mt-4">cancelar</button>
        </a>
    </section>
            <button type="submit" name="excluir" class="btn btn-danger  mt-4">Excluir</button>
        </div>

    </form>

</main>