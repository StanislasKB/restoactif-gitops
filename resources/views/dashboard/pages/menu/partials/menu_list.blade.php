  <div class="grid lg:grid-cols-3 grid-cols-1 gap-6">
      @if ($menus->count() == 0)
          <h2>Aucun menu créé</h2>
      @else
          @foreach ($menus as $menu)
              @include('dashboard.pages.menu.partials.menu')
          @endforeach
      @endif
  </div>
