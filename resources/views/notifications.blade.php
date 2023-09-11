<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ALL STUDENTS') }}
        </h2>
    </x-slot>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style scoped>
    .container {
        display: grid;
        place-items: center;
        margin-top: 50px;
    }

    .content {

        width: 57.5%;
        margin: 0 auto;

    }
    .searchBtn{
        text-align: right;
        margin-bottom: 30px;
        margin-right: 35px;
        transform: translateX(365px);

    }
    .searchInpt{
        width: 250px
    }

    .bookList{
        width: 1300px;
    }


@media (max-width: 1440px) and (max-height: 640px) {



    .content {
        width: 100%; /* Adjust width for smaller screens */

    }

    .searchBtn{
        text-align: right;
        margin-right: 15px;
        margin-bottom: -100px;
        transform: translateY(-110px)
    }
    .searchInpt{
        width: 100px
    }

    .bookList{
        margin-left: 30px;
        width: 630px;
        display: grid;
    }
    .transactions{
        display: grid;
        place-content: center;
    }

}

@media (max-width: 699px) and (max-height: 640px) {
    .content {
        width: 100%; /* Adjust width for smaller screens */

    }

    .searchBtn{
        text-align: right;
        margin-right: 20px;
        margin-bottom: -100px;
        transform: translateY(-110px)
    }
    .searchInpt{
        width: 100px
    }
    .bookList{
        width: 330px;
        display: grid;
    }
    .books{
        display: grid;
        place-content: center;
    }
    .transactions{
        display: grid;
        place-content: center;
    }
}

    </style>

    <div class="container">
        <div class="content">
          <div class="transactions">
                <div class="bookList" style="color: white; display: inline-flex; flex-wrap: wrap;">

                    <div>
                        <!-- Additional content when fines are present -->
                        @php
                            $totalFines = 0; // Initialize a variable to store the total fines
                        @endphp

                        @foreach($acceptedRequests as $request)
                            @if ($request->fines !== null)
                                @php
                                    $totalFines += $request->fines; // Add fines to the total
                                @endphp
                            @endif
                        @endforeach

                        @if ($totalFines > 0)
                            <div style="margin: 13px; border-radius: 10px; box-shadow: 10px 10px 20px 5px rgba(0, 0, 0, 0.298); background-color: rgb(71, 4, 4); padding: 20px">
                                <div>
                                    <div style="margin-bottom: 20px; width: 1175px;">
                                        <!-- Display the total fines -->
                                        <b>Hello  {{ $loggedInUser->name }},</b> <br> <br>
                                        <p>
                                            We hope this message finds you well. We would like to bring to your attention that the return date for the book(s) you borrowed,
                                            @foreach ($acceptedRequests as $request)
                                                @if ($request->book && $request->fines > 0)
                                                    "{{ $request->book->title }}"
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endif
                                            @endforeach
                                            has passed. As per our policy, a late fee of

                                            @foreach ($acceptedRequests as $request)
                                                @if ($request->book && $request->fines > 0)
                                                    {{$request->fines}} pesos for the "{{ $request->book->title }}"
                                                    @if (!$loop->last)
                                                        and
                                                    @endif
                                                @endif
                                            @endforeach
                                            has been applied to your account for each book. Please note that an additional
                                            @foreach ($acceptedRequests as $request)
                                                @if ($request->book && $request->fines > 0)
                                                    a late fee of {{$request->fines}} pesos for the "{{ $request->book->title }}"
                                                    @if (!$loop->last)
                                                        and
                                                    @endif
                                                @endif
                                            @endforeach

                                            will be added for each subsequent day that the book(s) remain(s) overdue. We kindly request you to return the book(s) as soon as possible to avoid further charges.
                                            <div style="margin-top: 50px; font-size: 50px;">
                                                Total Fines: {{$totalFines}}
                                            </div>
                                        </p>


                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    @foreach($acceptedRequests as $request)
                    <div>
                        <div style="margin: 13px; border-radius: 10px; box-shadow: 10px 10px 20px 5px rgba(0, 0, 0, 0.298); background-color: rgb(4, 51, 71); padding: 20px">
                            <div>
                                <div style="margin-bottom: 20px; width: 1175px;">
                                    <!-- Display accepted request data here, e.g., $request->field_name -->
                                    <b>Hello  {{ $loggedInUser->name }},</b> <br> <br>

                                    <p>
                                        We are pleased to inform you that your book request for "{{$request->book_title}}" has been confirmed. We have scheduled a pick-up
                                    time and date for your convenience. <br> <br>
                                    <hr>
                                     <br>

                                    <div>
                                        <b>Date Borrowed</b> <br>
                                        {{$request->date_borrow}}
                                    </div> <br>
                                    <div>
                                        <b>Date Pick-up</b> <br>
                                        {{$request->date_pickup}}
                                    </div> <br>
                                    <div>
                                        <b>Date Return</b> <br>
                                        {{$request->date_return}}
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
            </div>
        </div>
    </div>

</x-admin-layout>

<script>
 function clearSearchInput() {
        document.getElementById('id_number_search').value = '';
        document.getElementById('searchForm').submit();
    }
    const toggleButtons = document.querySelectorAll('.toggle-button');

    toggleButtons.forEach(button => {
        button.addEventListener('click', async () => {
            const form = button.closest('.toggle-form');
            const studentId = form.dataset.studentId;

            try {
                const response = await fetch(`{{ route('toggleAccountStatus', ['id' => '__STUDENT_ID__']) }}`.replace('__STUDENT_ID__', studentId), {
                    method: 'POST',
                    body: new FormData(form),
                });

                if (response.ok) {
                    // Toggle the button text and background color
                    const currentStatus = button.textContent.includes('Enabled') ? 'Enabled' : 'Disabled';
                    const newStatus = currentStatus === 'Enabled' ? 'Disabled' : 'Enabled';
                    const newColor = currentStatus === 'Enabled' ? 'red' : 'green';

                    button.textContent = `Account ${newStatus}`;
                    button.style.backgroundColor = newColor;
                }
            } catch (error) {
                console.error('Error toggling account status:', error);
            }
        });
    });
</script>
