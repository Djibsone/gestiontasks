<div id="app-sidepanel" class="app-sidepanel">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
            <a class="app-logo" href="{{ route('tasks.dashboard') }}">
                <img src="https://ui-avatars.com/api/?name={{ config('app.name', 'Gestion des Tâches') }}"
                    alt="user profile" class="logo-icon me-2">
                {{ config('app.name', 'Gestion des Tâches') }}
            </a>
        </div>
        
        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                <li class="nav-item">
                    
                    <a class="nav-link active" href="{{ route('tasks.dashboard') }}">
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                                <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                            </svg>
                        </span>
                        <span class="nav-link-text">Tableau de bord</span>
                    </a>
                    
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tasks.show') }}">
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" 
                                    d="M8 1a.5.5 0 0 1 .5.5v6h6a.5.5 0 0 1 0 1h-6v6a.5.5 0 0 1-1 0v-6h-6a.5.5 0 0 1 0-1h6v-6A.5.5 0 0 1 8 1z"/>
                            </svg>
                        </span>
                        <span class="nav-link-text">Créer une tâche</span>
                    </a>

                </li>             
            </ul>
            
        </nav>
        
        <div class="app-sidepanel-footer">
            <nav class="app-nav app-nav-footer">
                <ul class="app-menu footer-menu list-unstyled">
                    <li class="nav-item">
                       
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                            @csrf
                        </form>
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="nav-icon">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" 
                                        d="M10.828 5.172a.5.5 0 0 1 0 .707L8.707 8h5.586a.5.5 0 0 1 0 1H8.707l2.121 2.121a.5.5 0 0 1-.707.707l-3-3a.5.5 0 0 1 0-.707l3-3a.5.5 0 0 1 .707 0z"/>
                                    <path fill-rule="evenodd" 
                                        d="M4 1.5A1.5 1.5 0 0 0 2.5 3v10A1.5 1.5 0 0 0 4 14.5h4a.5.5 0 0 1 0 1H4A2.5 2.5 0 0 1 1.5 13V3A2.5 2.5 0 0 1 4 .5h4a.5.5 0 0 1 0 1H4z"/>
                                </svg>
                            </span>
                            <span class="nav-link-text">Déconnexion</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

