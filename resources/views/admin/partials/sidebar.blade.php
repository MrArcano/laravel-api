<aside>
    <nav class="my-3">
        <ul class=" px-4">
            <li class="text-center my-2 {{ Route::currentRouteName() === 'admin.home' ? 'active' : ''}}">
                <a class="btn btn-custom w-100" href="{{route('admin.home')}}"><i class="fa-solid fa-house"></i> Dashboard</a>
            </li>
            <li class="text-center my-2 {{ Route::currentRouteName() === 'admin.project.index' ? 'active' : ''}}">
                <a class="btn btn-custom w-100" href="{{ route('admin.project.index')}}"><i class="fa-solid fa-diagram-project"></i> Projects</a>
            </li>
            <li class="text-center my-2 {{ Route::currentRouteName() === 'admin.tecnology.index' ? 'active' : ''}}">
                <a class="btn btn-custom w-100" href="{{ route('admin.tecnology.index')}}"><i class="fa-solid fa-microchip"></i> Tecnologies</a>
            </li>
            <li class="text-center my-2 {{ Route::currentRouteName() === 'admin.type.index' ? 'active' : ''}}">
                <a class="btn btn-custom w-100" href="{{ route('admin.type.index')}}"><i class="fa-solid fa-circle-half-stroke"></i> Types</a>
            </li>
        </ul>
    </nav>
</aside>
