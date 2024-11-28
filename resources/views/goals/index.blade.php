@extends('layouts.app')

@section('title', 'Goals')

@section('content')
<div class="container goals-container">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="goals-title">Goals</h1>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addGoalModal">
        Tambahkan Goal
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
        <path d="M12.854.146a.5.5 0 0 1 .707 0l2.293 2.293a.5.5 0 0 1 0 .707l-9.193 9.193a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l9.193-9.193zm-9.9 10.803L10.293 3.61 12.39 5.707l-7.44 7.44-2.12-.707.707-2.12z"/>
        <path fill-rule="evenodd" d="M1 13.5V16h2.5l.5-.5H2v-1.5L1 13.5z"/>
    </svg>
</button>
    </div>

    <!-- Card Goals -->
    <div class="card mt-2 goals-card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table goals-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Goals</th>
                            <th>Complete</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($goals as $goal)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $goal->goals }}</td> <!-- Data goals berada di tengah -->
                                <td class="text-center">
                                    <input type="checkbox" class="form-check-input" {{ $goal->is_completed ? 'checked' : '' }}
                                      onchange="toggleGoal({{ $goal->id }}, this.checked)">
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-outline-dark btn-sm goals-btn" data-bs-toggle="modal"
                                        data-bs-target="#editGoalModal" data-id="{{ $goal->id }}" data-goal="{{ $goal->goals }}">
                                        Update
                                    </button>
                                    <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-dark btn-sm goals-btn"
                                            onclick="return confirm('Delete this goal?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No goals available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Goal -->
<div class="modal fade" id="addGoalModal" tabindex="-1" aria-labelledby="addGoalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('goals.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGoalModalLabel">Tambahkan Goal Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="goal" class="form-label">Goal</label>
                        <input type="text" name="goal" id="goal" class="form-control" placeholder="Masukan Goal" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit Goal -->
<div class="modal fade" id="editGoalModal" tabindex="-1" aria-labelledby="editGoalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editGoalForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Goal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="editGoal" name="goal" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const editGoalModal = document.getElementById('editGoalModal');
    editGoalModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const goalId = button.getAttribute('data-id');
        const goalText = button.getAttribute('data-goal');

        const form = document.getElementById('editGoalForm');
        form.action = `/goals/${goalId}`;
        document.getElementById('editGoal').value = goalText;
    });

    function toggleGoal(goalId, isCompleted) {
        fetch(`/goals/${goalId}/toggle`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ is_completed: isCompleted }),
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to update status.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    console.log('Goal status updated successfully.');
                }
            })
            .catch(error => {
                alert(error.message);
            });
    }
</script>
@endsection
