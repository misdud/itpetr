
                    <a class="btn btn-secondary @if($test == 'departs') active @endif"  href="{{ route('main_catalogs') }}" role="button"><i class="nc-icon nc-bullet-list-67 pl-1 pr-1"></i>Отделы</a>
                    <a class="btn btn-secondary @if($test == 'subdeprts') active @endif"  href="{{ route('sub_departments.index') }}" role="button"><i class="nc-icon nc-bullet-list-67 pl-1 pr-1"></i>Подразделения</a>
                    <a class="btn btn-secondary @if($test == 'positions') active @endif"  href="{{ route('positions.index') }}" role="button"><i class="nc-icon nc-money-coins pl-1 pr-1"></i>Должности</a>
                    <a class="btn btn-secondary @if($test == 'roles') active @endif"  href="{{ route('roles.index') }}" role="button"><i class="nc-icon nc-single-02 pl-1 pr-1"></i>Роли</a>
                    <a class="btn btn-primary @if($test == 'users') active @endif"  href="{{ route('users.index') }}" role="button"><i class="nc-icon nc-badge pl-1 pr-1"></i>Сотрудники</a>
