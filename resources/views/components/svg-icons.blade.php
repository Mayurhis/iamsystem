
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

    @case('metadata_icon')
    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_2060_2525)">
        <path d="M16.8047 2.3167H15.8098V1.7085C15.8098 1.06865 15.2895 0.54834 14.6496 0.54834H1.19531C0.555469 0.54834 0.0351562 1.06865 0.0351562 1.7085V14.5229C0.0351562 15.1628 0.555469 15.6831 1.19531 15.6831H2.19023V16.2878C2.19023 16.9276 2.71055 17.4479 3.35391 17.4479H16.8047C17.4445 17.4479 17.9648 16.9276 17.9648 16.2878V3.47686C17.9648 2.83701 17.4445 2.3167 16.8047 2.3167ZM0.428906 1.7085C0.428906 1.28311 0.773438 0.938574 1.19531 0.938574H14.6461C15.068 0.938574 15.4125 1.28311 15.4125 1.7085V2.71396H0.428906V1.7085ZM1.19531 15.2929C0.773438 15.2929 0.428906 14.9483 0.428906 14.5265V3.10771H15.416V14.5229C15.416 14.9448 15.0715 15.2894 14.6461 15.2894H1.19531V15.2929ZM17.5711 16.2913C17.5711 16.7132 17.2266 17.0577 16.8047 17.0577H3.35391C2.92852 17.0577 2.58398 16.7132 2.58398 16.2913V15.6866H14.6461C15.2859 15.6866 15.8063 15.1663 15.8063 14.5265V4.87607H17.5676V16.2913H17.5711ZM17.5711 4.48232H15.8098V2.70693H16.8047C17.2266 2.70693 17.5711 3.05147 17.5711 3.47334V4.48232ZM1.96172 1.54678C1.51523 1.55381 1.51523 2.22178 1.96172 2.22881C2.4082 2.22178 2.41172 1.55732 1.96172 1.54678ZM1.90898 1.88779C1.90898 1.821 2.01445 1.81748 2.01445 1.88779C2.01445 1.94756 1.90898 1.94756 1.90898 1.88779ZM3.24141 1.54678C2.79492 1.55381 2.79492 2.22178 3.24141 2.22881C3.68789 2.22178 3.68789 1.55732 3.24141 1.54678ZM3.18867 1.88779C3.18867 1.821 3.29414 1.81748 3.29414 1.88779C3.29414 1.94756 3.18867 1.94756 3.18867 1.88779ZM4.51758 1.54678C4.07109 1.55381 4.07109 2.22178 4.51758 2.22881C4.96758 2.22178 4.96758 1.55732 4.51758 1.54678ZM4.46484 1.88779C4.46484 1.821 4.57031 1.81748 4.57031 1.88779C4.57031 1.94756 4.46484 1.94756 4.46484 1.88779ZM14.168 6.25068L13.5035 6.20146C13.4965 6.18037 13.4859 6.16279 13.4789 6.1417L13.9113 5.63896C14.0414 5.49131 14.0344 5.27686 13.8938 5.13271L13.1906 4.42959C13.0535 4.29248 12.832 4.28545 12.6879 4.41201L12.1852 4.84795C12.1641 4.84092 12.1465 4.83037 12.1254 4.82334L12.0762 4.1624C12.0621 3.96904 11.9004 3.81787 11.707 3.81787H10.7121C10.5223 3.81787 10.357 3.96904 10.343 4.1624L10.2937 4.82334C10.2727 4.83037 10.2516 4.84092 10.234 4.84795L9.73125 4.41201C9.58359 4.28545 9.36914 4.296 9.22852 4.43311L8.52539 5.13623C8.38828 5.27334 8.37773 5.49131 8.50781 5.63896L8.94023 6.1417C8.9332 6.16279 8.92266 6.18037 8.91563 6.20146L8.25117 6.25068C8.05781 6.26475 7.91016 6.42998 7.91016 6.61982V7.61475C7.91016 7.81162 8.05781 7.96982 8.25469 7.98389L8.91563 8.03311C8.92266 8.0542 8.9332 8.07178 8.94023 8.09287L8.50781 8.59561C8.38125 8.74326 8.38828 8.96475 8.52539 9.09834L9.22852 9.80498C9.36563 9.94209 9.58359 9.94912 9.73125 9.82256L10.234 9.38662C10.2551 9.39717 10.2727 9.4042 10.2937 9.41123L10.343 10.0757C10.357 10.2655 10.5223 10.4167 10.7121 10.4167H11.707C11.9004 10.4167 12.0621 10.2655 12.0762 10.0722L12.1254 9.40771C12.1465 9.40068 12.1641 9.39014 12.1852 9.38311L12.6879 9.81904C12.832 9.9456 13.0535 9.93857 13.1906 9.80146L13.8938 9.09834C14.0309 8.96123 14.0379 8.73975 13.9113 8.59561L13.4789 8.09287C13.4859 8.07178 13.4965 8.0542 13.5035 8.03311L14.168 7.98389C14.3613 7.96631 14.509 7.80811 14.509 7.61475V6.61982C14.509 6.42998 14.3578 6.26475 14.168 6.25068ZM14.1152 7.59365L13.3488 7.6499C13.2715 7.65693 13.2012 7.70967 13.1766 7.7835C13.1449 7.92764 12.9691 8.10693 13.0957 8.25459L13.5984 8.83818L12.927 9.50967L12.3469 9.00693C12.1992 8.87686 12.0199 9.05615 11.8758 9.08779C11.802 9.1124 11.7492 9.1792 11.7422 9.26006L11.6859 10.0265H10.7367L10.6805 9.26006C10.6734 9.18271 10.6207 9.1124 10.5469 9.08779C10.4027 9.05615 10.2199 8.88037 10.0758 9.00693L9.49219 9.50967L8.8207 8.83467L9.32344 8.25107C9.45 8.0999 9.27773 7.93467 9.24609 7.77998C9.22148 7.70615 9.15117 7.65342 9.07383 7.64639L8.30742 7.59014V6.6374L9.07383 6.58115C9.15117 6.57412 9.22148 6.52139 9.24609 6.44756C9.28125 6.29287 9.45 6.12764 9.32344 5.97646L8.8207 5.39287L9.49219 4.72139L10.0758 5.22412C10.227 5.35068 10.3852 5.18193 10.5469 5.14326C10.6207 5.11865 10.6734 5.05186 10.6805 4.971L10.7367 4.20459H11.6859L11.7422 4.971C11.7492 5.04834 11.802 5.11865 11.8758 5.14326C12.0375 5.17842 12.1957 5.35068 12.3469 5.22412L12.927 4.72139L13.5984 5.39287L13.0957 5.97646C12.9691 6.12412 13.1449 6.30342 13.1766 6.44756C13.2012 6.52139 13.268 6.57412 13.3488 6.58115L14.1152 6.6374V7.59365ZM11.2078 5.52295C10.3289 5.52295 9.61523 6.23662 9.61523 7.11553C9.69609 9.22842 12.723 9.22842 12.8004 7.11553C12.8004 6.24014 12.0867 5.52295 11.2078 5.52295ZM11.2078 8.31787C9.62227 8.26865 9.62227 5.96943 11.2078 5.9167C12.7934 5.96943 12.7934 8.26865 11.2078 8.31787ZM3.36797 11.6577L2.01797 12.6421L3.36797 13.6265C3.45586 13.6897 3.47344 13.8128 3.41016 13.9007C3.34688 13.9886 3.22383 14.0062 3.13594 13.9429L1.56797 12.8003C1.51875 12.7651 1.48711 12.7054 1.48711 12.6421C1.48711 12.5788 1.51875 12.519 1.56797 12.4839L3.13594 11.3413C3.22383 11.278 3.34688 11.2956 3.41016 11.3835C3.47344 11.4714 3.45586 11.5944 3.36797 11.6577ZM7.75547 12.4839C7.86094 12.5577 7.86094 12.73 7.75547 12.8003L6.1875 13.9429C5.98008 14.094 5.74805 13.7776 5.95547 13.6265L7.30547 12.6421L5.95547 11.6577C5.74805 11.5065 5.98008 11.1901 6.1875 11.3413L7.75547 12.4839ZM5.82188 11.0671L3.89531 14.414C3.84258 14.5089 3.71953 14.5405 3.62812 14.4878C3.5332 14.4351 3.50156 14.312 3.5543 14.2206L5.48086 10.8702C5.53359 10.7753 5.65664 10.7437 5.74805 10.7964C5.84648 10.8526 5.87813 10.9722 5.82188 11.0671ZM1.68398 4.48232H5.03789C5.29453 4.48232 5.29453 4.87607 5.03789 4.87607H1.68398C1.42383 4.87607 1.42734 4.48232 1.68398 4.48232ZM1.68398 6.11006H5.03789C5.29453 6.11006 5.29453 6.50381 5.03789 6.50381H1.68398C1.42383 6.50381 1.42734 6.11006 1.68398 6.11006ZM1.68398 7.73779H6.85547C7.11563 7.73779 7.11211 8.13154 6.85547 8.13154H1.68398C1.42383 8.13154 1.42734 7.74131 1.68398 7.73779ZM6.85547 9.36553C7.11563 9.36553 7.11211 9.75928 6.85547 9.75928H1.68398C1.42383 9.75928 1.42734 9.36553 1.68398 9.36553H6.85547ZM14.3121 12.3538H10.9582C10.7016 12.3538 10.7016 11.9601 10.9582 11.9601H14.3121C14.5688 11.9601 14.5688 12.3538 14.3121 12.3538ZM14.3121 13.9815H10.9582C10.7016 13.9815 10.7016 13.5878 10.9582 13.5878H14.3121C14.5688 13.5878 14.5688 13.9815 14.3121 13.9815Z" fill="black"/>
        </g>
        <defs>
        <clipPath id="clip0_2060_2525">
        <rect width="18" height="18" fill="white"/>
        </clipPath>
        </defs>
        </svg>
    @break
        
        <!-- Default case if no matching icon is provided -->
@endswitch



