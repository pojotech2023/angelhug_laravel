@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;"><i class="fas fa-envelope-open-text me-2"></i> Service Enquiry Management</h3>
            <p class="text-muted small mb-0">Review and respond to service requests and contact messages from customers.</p>
        </div>
        <div>
            <form action="{{ route('admin.enquiries.index') }}" method="GET" class="d-flex gap-2">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search name, phone, message..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold" style="background-color: #048444; border-color: #048444;">Search</button>
                @if(request('search'))
                    <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Status Tabs -->
    <div class="d-flex gap-2 mb-3 flex-wrap">
        <a href="{{ route('admin.enquiries.index') }}" class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-outline-secondary' }} fw-bold">
            All Enquiries ({{ $statusCounts['all'] }})
        </a>
        <a href="{{ route('admin.enquiries.index', ['status' => 'new']) }}" class="btn btn-sm {{ request('status') === 'new' ? 'btn-danger' : 'btn-outline-danger' }} fw-bold">
            New ({{ $statusCounts['new'] }})
        </a>
        <a href="{{ route('admin.enquiries.index', ['status' => 'contacted']) }}" class="btn btn-sm {{ request('status') === 'contacted' ? 'btn-warning text-dark' : 'btn-outline-warning' }} fw-bold">
            Contacted ({{ $statusCounts['contacted'] }})
        </a>
        <a href="{{ route('admin.enquiries.index', ['status' => 'resolved']) }}" class="btn btn-sm {{ request('status') === 'resolved' ? 'btn-success' : 'btn-outline-success' }} fw-bold">
            Resolved ({{ $statusCounts['resolved'] }})
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Sender Info</th>
                        <th>Service / Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th style="width: 170px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enquiries as $index => $enquiry)
                        <tr>
                            <td>{{ $enquiries->firstItem() + $index }}</td>
                            <td>
                                <div><strong style="color: #048444;">{{ $enquiry->name }}</strong></div>
                                <small class="text-muted"><i class="fas fa-phone-alt me-1"></i> +91 {{ $enquiry->phone ?: 'N/A' }}</small><br>
                                <small class="text-muted"><i class="fas fa-envelope me-1"></i> {{ $enquiry->email }}</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $enquiry->subject ?: ($enquiry->service->title ?? 'General Enquiry') }}</span>
                            </td>
                            <td>
                                <p class="small text-muted mb-0" style="max-width: 280px;">
                                    {{ Str::limit($enquiry->message, 80) }}
                                </p>
                            </td>
                            <td>
                                <small class="text-muted">{{ $enquiry->created_at->format('M d, Y') }}</small><br>
                                <small class="text-muted">{{ $enquiry->created_at->format('H:i A') }}</small>
                            </td>
                            <td>
                                @if($enquiry->status === 'new')
                                    <span class="badge bg-danger">New</span>
                                @elseif($enquiry->status === 'contacted')
                                    <span class="badge bg-warning text-dark">Contacted</span>
                                @else
                                    <span class="badge bg-success">Resolved</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-primary me-1" 
                                        data-bs-toggle="modal" data-bs-target="#enquiryModal{{ $enquiry->id }}" title="View Full Message">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <form action="{{ route('admin.enquiries.destroy', $enquiry->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this enquiry?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal for viewing & updating this enquiry -->
                        <div class="modal fade" id="enquiryModal{{ $enquiry->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow rounded-4">
                                    <div class="modal-header" style="background: #048444; color: #fff;">
                                        <h5 class="modal-title fw-bold"><i class="fas fa-envelope-open me-2"></i> Enquiry Details</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('admin.enquiries.update_status', $enquiry->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body p-4">
                                            <div class="mb-3">
                                                <h5 class="fw-bold mb-1" style="color: #048444;">{{ $enquiry->name }}</h5>
                                                <div class="text-muted small">
                                                    <i class="fas fa-envelope me-1"></i> <a href="mailto:{{ $enquiry->email }}">{{ $enquiry->email }}</a> &nbsp;|&nbsp; 
                                                    <i class="fas fa-phone me-1"></i> <a href="tel:{{ $enquiry->phone }}">+91 {{ $enquiry->phone }}</a>
                                                </div>
                                            </div>

                                            <div class="p-3 bg-light rounded-3 mb-3">
                                                <small class="text-muted text-uppercase fw-bold d-block mb-1">Subject</small>
                                                <strong>{{ $enquiry->subject ?: 'General Enquiry' }}</strong>
                                                <hr class="my-2">
                                                <small class="text-muted text-uppercase fw-bold d-block mb-1">Message</small>
                                                <p class="mb-0 text-dark" style="white-space: pre-wrap;">{{ $enquiry->message }}</p>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Update Status</label>
                                                <select name="status" class="form-select">
                                                    <option value="new" {{ $enquiry->status === 'new' ? 'selected' : '' }}>New</option>
                                                    <option value="contacted" {{ $enquiry->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                                    <option value="resolved" {{ $enquiry->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                                </select>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Internal Admin Notes</label>
                                                <textarea name="admin_notes" class="form-control" rows="2" placeholder="e.g. Spoke to customer, appointment confirmed...">{{ $enquiry->admin_notes }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary fw-bold" style="background: #048444; border-color: #048444;">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fs-2 mb-2 d-block"></i>
                                No customer enquiries found in this view.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($enquiries->hasPages())
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $enquiries->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>
@endsection
