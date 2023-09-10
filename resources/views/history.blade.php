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

                    @foreach ($userNotifications as $userNotification)
                        <div>
                            <div style="margin: 13px; border-radius: 10px; box-shadow: 10px 10px 20px 5px rgba(0, 0, 0, 0.298); background-color: rgb(4, 51, 71); padding: 20px">
                                <div>
                                    <div style="margin-bottom: 20px; width: 240px;">
                                        <!-- Display the notification text -->
                                        {{ $userNotification->notification->notification_text }}
                                    </div>
                                    <!-- Add a Clear button with a form to delete the notification -->
                                    <form action="{{ route('clearNotification', ['id' => $userNotification->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Clear</button>
                                    </form>

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
