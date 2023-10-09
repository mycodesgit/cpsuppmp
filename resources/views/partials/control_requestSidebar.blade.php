@php
    $curr_route = request()->route()->getName();

    $pdfActive = in_array($curr_route, ['PDFprRead']) ? 'active' : '';
@endphp

<ul class="nav nav-pills flex-column">
    <li class="nav-item">
        <a href="{{ route('pending_list') }}" class="nav-link2" style="color: #000;">
            <i class="fas fa-clock"></i> Pending Request
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('approved_list') }}" class="nav-link2" style="color: #000;">
            <i class="fas fa-check"></i> Approved Request
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('PDFprRead') }}" class="nav-link2 {{ $pdfActive }}" style="color: #000;">
            <i class="fas fa-file-pdf"></i> PR Form Template
        </a>
    </li>
</ul>