<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ALL STUDENTS') }}
        </h2>
    </x-slot>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
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
    }
    .searchInpt{
        width: 250px
    }


@media (max-width: 360px) and (max-height: 640px) {
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
}
    </style>

    <div class="container">
        <div class="content">
            <div class="searchBtn">
                {{-- <form action="{{ route('student') }}" method="GET">
                    <input class="searchInpt" style="text-align:center; border-radius: 20px; color:black;" type="text" name="id_number_search" placeholder="ID Number, Name">
                    <button type="submit" style="color:white; border-radius: 5px; background-color: rgb(4, 51, 71); padding: 10px;">Search</button>
                </form> --}}
            </div>
            <div style="color: white; display: inline-flex; flex-wrap: wrap;">
                {{-- @foreach ($students as $student) --}}
                    <div>
                        <div style="margin: 13px; border-radius: 10px; box-shadow: 10px 10px 20px 5px rgba(0, 0, 0, 0.298); background-color: rgb(4, 51, 71); padding: 20px">
                            <div>
                                <div style="margin-bottom: 20px;">
                                    <b></b> <br>  <br>
                                </div>

                                </div>

                                <div>
                                    {{-- Form --}}
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- @endforeach --}}
            </div>
        </div>
    </div>

</x-admin-layout>

<script>
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
