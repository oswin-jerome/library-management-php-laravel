<nav id="myNav">
    <div class="logo-section">
        
        <img src="{{asset('images/gb2.svg')}}"  class="logo" alt="">
        
    </div>
    <ul>
        {{-- {{Request::path()}} --}}
        
        <li><a @if (Request::is('dashboard')) class="active" @endif href="/dashboard"> Dashboard</a></li>
        <li><a @if (Request::is('books')||Request::is('books/*')) class="active" @endif href="/books"> Books</a></li>
        <li><a @if (Request::is('authors')||Request::is('authors/*')) class="active" @endif href="/authors"> Authors</a></li>
        <li><a @if (Request::is('categories')||Request::is('categories/*')) class="active" @endif href="/categories"> Categories</a></li>
        <li><a @if (Request::is('departments')||Request::is('departments/*')) class="active" @endif href="/departments"> Departments</a></li>
        <li><a @if (Request::is('members')||Request::is('members/*')) class="active" @endif href="/members"> Members</a></li>
        <li><a @if (Request::is('issue_book')||Request::is('issue_book/*')) class="active" @endif href="/issue_book"> Issue Book</a></li>
        <li><a @if (Request::is('about')||Request::is('about/*')) class="active" @endif href="/about">About</a></li>
    </ul>
</nav>

<style>
    .logo{
        width: 70% !important;
        padding: 20px 0px;
    }
</style>
