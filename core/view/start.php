<form id="formSend" class="row g-3 d-sm-flex">
    <div class="row">
        <div class="col-6">
            <label for="Name" class="form-label">Имя</label>
            <input type="text" name="name" class="form-control" id="Name" placeholder="">
        </div>
        <div class="col-6">
            <label for="surname" class="form-label">Фамилия</label>
            <input type="text" class="form-control" name="surname" id="surname" placeholder="">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label for="mail" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="mail" name="mail" placeholder="name@example.com">
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="pass">
        </div>
        <div class="col-6">
            <label for="repassword" class="form-label">Повторить пароль</label>
            <input type="password" class="form-control" id="repassword" name="repass">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Добавить пользователя</button>
        </div>
    </div>
</form>