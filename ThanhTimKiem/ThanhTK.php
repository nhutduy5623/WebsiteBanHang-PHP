<div class="container">
      <div class="d-flex justify-content-center">
        <div class="searchbar">
          <input class="search_input" type="text" name="" value="" placeholder="Search...">
          <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
        </div>
      </div>
</div>

<style>
    .searchbar{
    margin-bottom: auto;
    margin-top: auto;
    height: 50%;
    background-color: #94b0b7;
    border-radius: 30px;
    }

    .search_input{
    color: white;
    border: 0;
    outline: 0;
    background: none;
    width: 0;
    caret-color: #353b48;
    line-height: 100%;
    transition: width 0.4s linear;
    margin-top: 5px;
    color: #353b48;
    }

    .search_input{
    padding: 0 10px;
    width: 300px;
    caret-color:#353b48;
    transition: width 0.4s linear;
    }

    .searchbar:hover > .search_icon{
    background: #4a707a;
    color: rgb(48, 206, 156);
    }

    .search_icon{
    height: 30px;
    width: 35px;
    float: right;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    color: #353b48;
    text-decoration:none;
    }


    @media only screen and (max-width: 800px) {
    .searchbar{
    margin-bottom: auto;
    margin-top: auto;
    height: 50%;
    background-color: #94b0b7;
    border-radius: 30px;
    }

    .search_input{
    color: white;
    border: 0;
    outline: 0;
    background: none;
    width: 0;
    caret-color:transparent;
    line-height: 100%;
    transition: width 0.4s linear;
    color: #353b48;
    }

    .searchbar:hover > .search_input{
    padding: 0 10px;
    width: 200px;
    caret-color:red;
    transition: width 0.4s linear;
    }

    .searchbar:hover > .search_icon{
    background: white;
    color: #e74c3c;
    }

    .search_icon{
    height: 30px;
    width: 30px;
    float: right;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    color:white;
    text-decoration:none;
    }
}
</style>

