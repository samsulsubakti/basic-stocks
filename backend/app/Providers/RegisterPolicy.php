<?php

namespace App\Providers;

class RegisterPolicy
{
    const POLICIES = [
        //Base
        \App\Models\Base\User::class => \App\Policies\Base\UserPolicy::class,
        \App\Models\Base\File::class => \App\Policies\Base\FilePolicy::class,
        \App\Models\Base\FilePivot::class=>\App\Policies\Base\FilePivotPolicy::class,
        \App\Models\Base\Role::class => \App\Policies\Base\RolePolicy::class,
        \App\Models\Base\UserRole::class => \App\Policies\Base\UserRolePolicy::class,

        //Travel
        \App\Models\Travel\HotelRecommendation::class => \App\Policies\Travel\HotelRecommendationPolicy::class,
        \App\Models\Travel\FlightRecommendation::class => \App\Policies\Travel\FlightRecommendationPolicy::class,
        \App\Models\Travel\Notification::class => \App\Policies\Travel\NotificationPolicy::class,
        \App\Models\Travel\BookingMember::class => \App\Policies\Travel\BookingMemberPolicy::class,
        \App\Models\Travel\Booking::class => \App\Policies\Travel\BookingPolicy::class,
        \App\Models\Travel\BookingHotelDetail::class => \App\Policies\Travel\BookingHotelDetailPolicy::class,

        //Master
        \App\Models\Master\Unit::class => \App\Policies\Master\UnitPolicy::class,
        \App\Models\Master\Permission::class => \App\Policies\Master\PermissionPolicy::class,
        \App\Models\Master\UserPermission::class => \App\Policies\Master\UserPermissionPolicy::class,
        \App\Models\Master\RolePermission::class => \App\Policies\Master\RolePermissionPolicy::class,
        \App\Models\Master\Position::class => \App\Policies\Master\PositionPolicy::class,
        \App\Models\Master\Rank::class => \App\Policies\Master\RankPolicy::class,
        \App\Models\Master\Echelon::class => \App\Policies\Master\EchelonPolicy::class,
        \App\Models\Master\Country::class => \App\Policies\Master\CountryPolicy::class,
        \App\Models\Master\Province::class => \App\Policies\Master\ProvincePolicy::class,
        \App\Models\Master\Regency::class => \App\Policies\Master\RegencyPolicy::class,
        \App\Models\Master\Member::class => \App\Policies\Master\MemberPolicy::class,
        \App\Models\Master\DomesticPerDiem::class => \App\Policies\Master\DomesticPerDiemPolicy::class,
        \App\Models\Master\DomesticRepresentationMoney::class => \App\Policies\Master\DomesticRepresentationMoneyPolicy::class,
        \App\Models\Master\DomesticLodgingCost::class => \App\Policies\Master\DomesticLodgingCostPolicy::class,
        \App\Models\Master\DomesticMeetingPerDiem::class => \App\Policies\Master\DomesticMeetingPerDiemPolicy::class,
        \App\Models\Master\OverseasTravelCost::class => \App\Policies\Master\OverseasTravelCostPolicy::class,
        \App\Models\Master\MeetingCostUnit::class => \App\Policies\Master\MeetingCostUnitPolicy::class,
        \App\Models\Master\DomesticFlightTicketCost::class => \App\Policies\Master\DomesticFlightTicketCostPolicy::class,
        \App\Models\Master\OverseaRoundTripFlightCost::class => \App\Policies\Master\OverseaRoundTripFlightCostPolicy::class,
        \App\Models\Master\OverseaOneWayFlightCost::class => \App\Policies\Master\OverseaOneWayFlightCostPolicy::class,
        \App\Models\Master\Airline::class => \App\Policies\Master\AirlinePolicy::class,
        \App\Models\Master\Airport::class => \App\Policies\Master\AirportPolicy::class,
        \App\Models\Master\InternationalAirport::class => \App\Policies\Master\InternationalAirportPolicy::class,
        \App\Models\Master\DomesticTaxiCost::class => \App\Policies\Master\DomesticTaxiCostPolicy::class,
        \App\Models\Master\IncidentalActivityVehicleRent::class => \App\Policies\Master\IncidentalActivityVehicleRentPolicy::class,
        \App\Models\Master\OfficialOperationVehicleRent::class => \App\Policies\Master\OfficialOperationVehicleRentPolicy::class,
        \App\Models\Master\OfficeOperationVehicleRent::class => \App\Policies\Master\OfficeOperationVehicleRentPolicy::class,
        \App\Models\Master\Employee::class => \App\Policies\Master\EmployeePolicy::class,
        \App\Models\Master\Group::class => \App\Policies\Master\GroupPolicy::class,
        \App\Models\Master\Policy::class => \App\Policies\Master\PolicyPolicy::class,
        \App\Models\Master\PolicyPivot::class => \App\Policies\Master\PolicyPivotPolicy::class,

        //Moderation
        \App\Models\Moderation\ModModeration::class => \App\Policies\Moderation\ModModerationPolicy::class,
        \App\Models\Moderation\ModModerationItem::class => \App\Policies\Moderation\ModModerationItemPolicy::class,
        \App\Models\Moderation\ModModerationUser::class => \App\Policies\Moderation\ModModerationUserPolicy::class,

        //Task
        \App\Models\Task\Task::class => \App\Policies\Task\TaskPolicy::class,
        \App\Models\Task\TaskModification::class => \App\Policies\Task\TaskModificationPolicy::class,
        \App\Models\Task\TaskParticipant::class => \App\Policies\Task\TaskParticipantPolicy::class,
        \App\Models\Task\TaskModificationParticipant::class => \App\Policies\Task\TaskModificationParticipantPolicy::class,

        //Trip
        \App\Models\Trip\Trip::class=>\App\Policies\Trip\TripPolicy::class,
        \App\Models\Trip\TripParticipant::class=>\App\Policies\Trip\TripParticipantPolicy::class,

        //Budget
        \App\Models\Budget\Coas::class => \App\Policies\Budget\CoasPolicy::class,
        \App\Models\Budget\Budget::class => \App\Policies\Budget\BudgetPolicy::class,
        \App\Models\Budget\BudgetDetail::class => \App\Policies\Budget\BudgetDetailPolicy::class,
        \App\Models\Budget\BudgetItem::class => \App\Policies\Budget\BudgetItemPolicy::class,
        \App\Models\Budget\Invoice::class => \App\Policies\Budget\InvoicePolicy::class,
        \App\Models\Budget\InvoiceAttachment::class => \App\Policies\Budget\InvoiceAttachmentPolicy::class,
        \App\Models\Budget\InvoiceItem::class => \App\Policies\Budget\InvoiceItemPolicy::class,
        \App\Models\Budget\Payment::class => \App\Policies\Budget\PaymentPolicy::class,

        //Skyview
        \App\Models\Skyview\Airport::class => \App\Policies\Skyview\AirportPolicy::class,
        \App\Models\Skyview\AirportService::class => \App\Policies\Skyview\AirportServicePolicy::class,
        \App\Models\Skyview\AuditCategory::class => \App\Policies\Skyview\AuditCategoryPolicy::class,
        \App\Models\Skyview\AuditElement::class => \App\Policies\Skyview\AuditElementPolicy::class,
        \App\Models\Skyview\AuditOccurance::class => \App\Policies\Skyview\AuditOccurancePolicy::class,
        \App\Models\Skyview\EventType::class => \App\Policies\Skyview\EventTypePolicy::class,
        \App\Models\Skyview\FundingType::class => \App\Policies\Skyview\FundingTypePolicy::class,
        \App\Models\Skyview\Group::class => \App\Policies\Skyview\GroupPolicy::class,
        \App\Models\Skyview\Operator::class => \App\Policies\Skyview\OperatorPolicy::class,
        \App\Models\Skyview\RRT::class => \App\Policies\Skyview\RRTPolicy::class,
        \App\Models\Skyview\Instance::class => \App\Policies\Skyview\InstancePolicy::class,
        \App\Models\Skyview\AirportCertificate::class => \App\Policies\Skyview\AirportCertificatePolicy::class,
        \App\Models\Skyview\PartnerCertificate::class => \App\Policies\Skyview\PartnerCertificatePolicy::class,
        \App\Models\Skyview\Audit::class => \App\Policies\Skyview\AuditPolicy::class,
        \App\Models\Skyview\AuditDetails::class => \App\Policies\Skyview\AuditDetailsPolicy::class,
        \App\Models\Skyview\Incident::class => \App\Policies\Skyview\IncidentPolicy::class,
        \App\Models\Skyview\Exemption::class => \App\Policies\Skyview\ExemptionPolicy::class,
        \App\Models\Skyview\Surveillance::class => \App\Policies\Skyview\SurveillancePolicy::class
    ];
}
