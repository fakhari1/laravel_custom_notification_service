<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
        <a class="navbar-brand ml-4" href="#" style="font-family: 'Ubuntu Medium', sans-serif;">F4KH4R!1</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex flex-grow-1 justify-content-between">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-inline-block" style="margin-top: 10px;" href="#"
                   id="navbarDropdownMenuLink" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    اطلاع رسانی
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" style="direction: rtl; text-align: right;"
                           href="{{ route('notifications.form.email') }}">ایمیل</a></li>
                    <li><a class="dropdown-item" style="direction: rtl; text-align: right;" href="{{ route('notifications.form.sms') }}">پیام کوتاه</a></li>
                </ul>
            </li>
            <form class="d-flex justify-content-between">
                <input class="form-control form-control-sm ml-2" type="search" placeholder="جستجو" aria-label="Search">
                <button class="btn btn-outline-success btn-sm" type="submit">جستجو</button>
            </form>
        </div>
    </div>
</nav>
