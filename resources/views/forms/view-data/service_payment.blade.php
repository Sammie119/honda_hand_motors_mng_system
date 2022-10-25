<div><strong>Car No: </strong>{{ $services->first()->car_no }} - <strong>Car Model: </strong> {{ $services->first()->customer->car_model }}</div>
<hr>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Charge</th>
            <th scope="col">Paid</th>
            <th scope="col">Balance</th>
            <th scope="col">Engineer</th>
            <th scope="col">Date</th>
            <th scope="col">Staff</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            @forelse ($services as $key => $service)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ formatCedisAmount($service->ser_charge) }}</td>
                    <td>{{ formatCedisAmount($service->amount_paid) }}</td>
                    <td>{{ formatCedisAmount($service->ser_charge - $service->amount_paid) }}</td>
                    <td>{{ getFirstname($service->engineer) }}</td>
                    <td>{{ formatDate($service->service_date) }}</td>
                    <td>{{ getUsername($service->user) }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="reprint_receipt/{{ $service->service_id }}" class="btn btn-info btn-sm print" title="Reprint Receipt">Print</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">No data Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<hr width="104%" style="margin-left: -15px; background: #bbb">
<div class="float-end">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>