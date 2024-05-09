
@switch($icon)
    @case('add')
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
    @break
    @case('edit')
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
    @break
   
    @case('delete')
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
    @break

    @case('user_lock')
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_2002_4)">
        <path d="M8 0C4.691 0 2 2.691 2 6C2 9.309 4.691 12 8 12C11.309 12 14 9.309 14 6C14 2.691 11.309 0 8 0ZM8 11C5.243 11 3 8.757 3 6C3 3.243 5.243 1 8 1C10.757 1 13 3.243 13 6C13 8.757 10.757 11 8 11ZM11.942 15.599C11.814 15.844 11.511 15.937 11.267 15.807C10.267 15.279 9.138 15 8 15C4.14 15 1 18.14 1 22V23.5C1 23.776 0.776 24 0.5 24C0.224 24 0 23.776 0 23.5V22C0 17.589 3.589 14 8 14C9.3 14 10.591 14.319 11.734 14.923C11.978 15.052 12.072 15.354 11.942 15.598V15.599ZM22 15.339V13.501C22 11.571 20.43 10.001 18.5 10.001C16.57 10.001 15 11.571 15 13.501V15.339C13.819 15.902 13 17.108 13 18.501V20.501C13 22.431 14.57 24.001 16.5 24.001H20.5C22.43 24.001 24 22.431 24 20.501V18.501C24 17.108 23.181 15.902 22 15.339ZM16 13.501C16 12.123 17.122 11.001 18.5 11.001C19.878 11.001 21 12.123 21 13.501V15.037C20.837 15.014 20.67 15.001 20.5 15.001H16.5C16.33 15.001 16.163 15.013 16 15.037V13.501ZM23 20.501C23 21.879 21.878 23.001 20.5 23.001H16.5C15.122 23.001 14 21.879 14 20.501V18.501C14 17.123 15.122 16.001 16.5 16.001H20.5C21.878 16.001 23 17.123 23 18.501V20.501ZM19.5 19.501C19.5 20.053 19.052 20.501 18.5 20.501C17.948 20.501 17.5 20.053 17.5 19.501C17.5 18.949 17.948 18.501 18.5 18.501C19.052 18.501 19.5 18.949 19.5 19.501Z" fill="white"/>
        </g>
        <defs>
        <clipPath id="clip0_2002_4">
        <rect width="24" height="24" fill="white"/>
        </clipPath>
        </defs>
      </svg>
    @break
        
        
        <!-- Default case if no matching icon is provided -->
@endswitch



