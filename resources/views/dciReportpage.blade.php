@extends('layouts.master')
@section('content')

<style>
/* ================= SCROLL CONTAINER ================= */
.table-responsive {
    overflow: auto;
    max-height: 600px;
    position: relative;
}

/* ================= TABLE BASE ================= */
#resizableTable {
    border-collapse: separate;
    border-spacing: 0;
    min-width: max-content;
}

/* Table Cells */
#resizableTable th,
#resizableTable td {
    white-space: nowrap;
    border: 1px solid #dee2e6;
    background-clip: padding-box;
}

/* ================= STICKY HEADER ================= */
#resizableTable thead th {
    position: sticky;
    top: 0;
    background: #343a40;
    color: #fff;
    z-index: 100;
}

#resizableTable thead tr:nth-child(2) th {
    z-index: 101;
}

/* ================= STICKY FIRST 6 COLUMNS ================= */
.sticky-col {
    position: sticky;
    background: #f1f3f5;
    z-index: 50;
}

#resizableTable thead .sticky-col {
    background: #343a40;
    z-index: 200;
}

.shadow-divider {
    box-shadow: 4px 0 6px rgba(0, 0, 0, 0.15);
}

/* ================= ALL ROWS GREY ================= */
#resizableTable tbody td {
    background-color: #f1f3f5;
}

#resizableTable tbody tr:hover td {
    background-color: #e2e6ea !important;
}

#resizableTable tbody tr:hover td.sticky-col {
    background-color: #e2e6ea !important;
}

/* Column widths */
.date-cell {
    min-width: 110px;
}

.doc-column {
    min-width: 200px;
    max-width: 260px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* show 2 lines */
    -webkit-box-orient: vertical;
    word-break: break-word;
    white-space: normal;
}

.wrap-header {
    white-space: normal !important;
    text-align: center;
}

.revision-header {
    text-align: center;
    font-weight: bold;
}

.desc-preview {
    cursor: pointer;
    color: #0d6efd;
    text-decoration: underline;
}
</style>

<h4 class="card-title mb-4">DCI REPORT</h4>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="resizableTable" class="table table-bordered">
                @php 
                    $maxRevision = $records->max(fn($r) => $r->revisions->count()) ?? 0; 
                @endphp
                <thead>
                    <tr>
                        <th rowspan="2">Sr No</th>
                        <th rowspan="2" class="wrap-header">Document<br>Number</th>
                        <th rowspan="2" class="wrap-header">Client<br>Document</th>
                        <th rowspan="2">Description</th>
                        <th rowspan="2">Tag</th>
                        <th rowspan="2">Mfg Serial</th>
                        @for($i=0;$i<$maxRevision;$i++)
                            <th colspan="6" class="revision-header">Revision {{ $i }}</th>
                        @endfor
                    </tr>
                    <tr>
                        @for($i=0;$i<$maxRevision;$i++)
                            <th>Issued Date</th>
                            <th>Issued Document</th>
                            <th>Input Date</th>
                            <th>Input Document</th>
                            <th>Status</th>
                            <th>Remark</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $i=>$row)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $row->calculation_drawing_document_id }}</td>
                            <td>{{ $row->client_document }}</td>
                            {{-- DESCRIPTION (2 words + popup) --}}
                            <td>
                                @php 
                                    $shortDesc = \Illuminate\Support\Str::words($row->document_description, 2, '...');
                                @endphp
                                <span class="desc-preview" data-full="{{ $row->document_description }}">
                                    {{ $shortDesc }}
                                </span>
                            </td>
                            <td>{{ $row->tag_no }}</td>
                            <td>{{ $row->mfg_serial_no }}</td>

                            @foreach($row->revisions as $rev)
                                <td class="date-cell">{{ $rev->issued_date }}</td>
                                <td class="doc-column">{{ $rev->issued_document }}</td>
                                <td class="date-cell">{{ $rev->input_date }}</td>
                                <td class="doc-column">{{ $rev->input_document }}</td>
                                <td>{{ $rev->status_id }}</td>
                                <td>{{ $rev->remark }}</td>
                            @endforeach

                            @for($j=$row->revisions->count(); $j<$maxRevision; $j++)
                                <td></td><td></td><td></td><td></td><td></td><td></td>
                            @endfor
                        </tr>
                    @empty
                        <tr>
                            <td colspan="50" class="text-center text-danger">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>
    </div>
</div>

<!-- DESCRIPTION MODAL -->
<div class="modal fade" id="descriptionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Full Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="fullDescriptionText"></p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const table = document.getElementById("resizableTable");

    /* Apply sticky left dynamically */
    function applySticky() {
        const rows = table.querySelectorAll("tr");

        rows.forEach(row => {
            let left = 0;

            for (let i = 0; i < 6; i++) {
                const cell = row.children[i];

                if (cell) {
                    cell.classList.remove("sticky-col", "shadow-divider");
                    cell.style.left = null;

                    cell.classList.add("sticky-col");
                    cell.style.left = left + "px";

                    left += cell.offsetWidth;

                    if (i === 5) {
                        cell.classList.add("shadow-divider");
                    }
                }
            }
        });
    }

    function fixHeaderHeight() {
        const firstRow = table.querySelector("thead tr:first-child");
        const secondRowCells = table.querySelectorAll("thead tr:nth-child(2) th");

        if (firstRow) {
            let height = firstRow.offsetHeight;
            secondRowCells.forEach(th => {
                th.style.top = height + "px";
            });
        }
    }

    applySticky();
    fixHeaderHeight();

    window.addEventListener("resize", function() {
        applySticky();
        fixHeaderHeight();
    });

    /* Description Modal */
    const modal = new bootstrap.Modal(document.getElementById('descriptionModal'));
    const descText = document.getElementById('fullDescriptionText');

    document.querySelectorAll('.desc-preview').forEach(item => {
        item.addEventListener('click', function() {
            descText.textContent = this.getAttribute('data-full');
            modal.show();
        });
    });
});
</script>

@endsection