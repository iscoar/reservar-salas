<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Rutas para el CRUD de las salas de junta
Route::get('/meeting-rooms', 'MeetingRoom\Actions\ShowAllMeetingRooms');
Route::post('/meeting-room', 'MeetingRoom\Actions\CreateMeetingRoom');
Route::put('/meeting-room/{room_id}', 'MeetingRoom\Actions\EditMeetingRoom');
Route::delete('/meeting-room/{room_id}', 'MeetingRoom\Actions\DeleteMeetingRoom');

// Rutas para las reservas de las salas de junta
Route::post('/meeting-room/{room_id}/booking', 'Booking\Actions\CreateBooking');
Route::put('/meeting-room/{room_id}/booking/cancel', 'Booking\Actions\CancelBooking');
