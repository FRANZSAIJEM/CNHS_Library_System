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

    .studList{
        width: 1250px;

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

    .studList{
        margin-left: 20px;
        width: 330px;
        display: grid;

    }

}
    </style>

    <div class="container">
        <div class="content">
            <div class="searchBtn">
                <form action="{{ route('student') }}" method="GET">
                    <input class="searchInpt" style="text-align:center; border-radius: 20px; color:black;" type="text" name="id_number_search" placeholder="ID Number, Name">
                    <button type="submit" style="color:white; border-radius: 5px; background-color: rgb(4, 51, 71); padding: 10px;">Search</button>
                </form>
            </div>
            <div class="studList" style="color: white; display: inline-flex; flex-wrap: wrap;">
                @foreach ($students as $student)
                        <div style="margin: 30px; border-radius: 10px; box-shadow: 10px 10px 20px 5px rgba(0, 0, 0, 0.298); background-color: rgb(4, 51, 71); padding: 20px">
                            <div style="background-position: center center; border-radius: 5px; width: 211px; ">
                                <div style="margin-bottom: 20px;">
                                    <b>Full Name</b> <br> {{$student->name}} <br>
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <b>ID Number</b> <br> {{$student->id_number}} <br>
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <b>Email</b> <br> {{$student->email}} <br>
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <b>Contact Number</b> <br> {{$student->contact}} <br>
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <b>Grade Level </b> <br> {{$student->grade_level}} <br>
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <b>Total Fines</b> <br>₱ &nbsp;{{ number_format($student->totalFines, 2) ?? '0.00' }} <br>
                                </div>

                                <div>
                                    <form class="toggle-form" data-student-id="{{ $student->id }}" style="display: inline;">
                                        @csrf
                                        <button class="toggle-button" type="button"
                                                style="width: 210px; padding: 10px; border-radius: 5px; background-color: {{ $student->is_disabled ? 'red' : 'green' }}; color: white;">
                                            {{ $student->is_disabled ? 'Account Disabled' : 'Account Enabled' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div style="text-align: right">
                        <div style="">
                            <form action="{{ route('student') }}" method="GET">
                                <input style="text-align:center; border-radius: 20px; color:black;" type="text" name="id_number_search" placeholder="Search ID Number">
                                <button type="submit" style="border-radius: 5px; background-color: blue; padding: 10px;">Search</button>
                            </form>
                        </div>
                    </div>
                    <div style="display: inline-flex; flex-wrap: wrap;" class="student-container" id="studentContainer">
                        @foreach ($students as $student)
                            <div>
                                <div style="margin: 20px; border-radius: 10px; box-shadow: 10px 10px 20px 5px rgba(0, 0, 0, 0.298); width: 335px; background-color: rgb(4, 51, 71); display: inline-flex; padding: 20px">
                                    <div>
                                        <b>Full Name</b> <br> {{$student->name}} <br> <br>
                                        <b>ID Number</b> <br> {{$student->id_number}} <br> <br>
                                        <b>Email</b> <br> {{$student->email}} <br> <br>
                                        <b>Contact Number</b> <br> {{$student->contact}} <br> <br>
                                        <b>Grade Level </b> <br> {{$student->grade_level}} <br> <br>
                                        <b>Total Fines </b> <br> P10.00 <br> <br>

                                        <div>
                                            <form class="toggle-form" data-student-id="{{ $student->id }}" style="display: inline;">
                                                @csrf
                                                <button class="toggle-button" type="button"
                                                        style="width: 295px; padding: 10px; border-radius: 5px; background-color: {{ $student->is_disabled ? 'red' : 'green' }}; color: white;">
                                                    {{ $student->is_disabled ? 'Account Disabled' : 'Account Enabled' }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
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
