@php
    $curr_route = request()->route()->getName();

    $createActive = in_array($curr_route, ['prCreate']) ? 'active' : '';
    $pendingActive = in_array($curr_route, ['pendingListRead']) ? 'active' : '';
    $approvedActive = in_array($curr_route, ['approvedListRead']) ? 'active' : '';
    $pdfprActive = in_array($curr_route, ['PDFprRead']) ? 'active' : '';
    $pdfbarsActive = in_array($curr_route, ['PDFbarsRead']) ? 'active' : '';
@endphp

<ul class="nav nav-pills flex-column">
    <li class="nav-item">
        <a href="{{ route('prCreate') }}" class="nav-link2 {{ $createActive }}" style="color: #000;">
            <i class="fas fa-plus"></i> Create New
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('pendingListRead') }}" class="nav-link2 {{ $pendingActive }}" style="color: #000;">
            <i class="fas fa-clock"></i> Pending Request
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('approvedListRead') }}" class="nav-link2 {{ $approvedActive }}" style="color: #000;">
            <i class="fas fa-check"></i> Approved Request
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('PDFprRead') }}" class="nav-link2 {{ $pdfprActive }}" style="color: #000;">
            <i class="fas fa-file-pdf"></i> PR Form Template
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('PDFbarsRead') }}" class="nav-link2 {{ $pdfbarsActive }}" style="color: #000;">
            <i class="fas fa-file-pdf"></i> Request BAR Slip
        </a>
    </li>
</ul>