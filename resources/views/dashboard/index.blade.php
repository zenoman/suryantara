@extends('layout.masteradmin')

@section('content')
<div class="page-content">
	    <div class="container-fluid">
	       
	
	        <div class="row">
	            <div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title">Recent orders</h3>
	                    </header>
	                    <div class="box-typical-body panel-body">
	                        <table class="tbl-typical">
	                            <tr>
	                                <th><div>Status</div></th>
	                                <th><div>Clients</div></th>
	                                <th align="center"><div>Orders#</div></th>
	                                <th align="center"><div>Date</div></th>
	                            </tr>
	                            <tr>
	                                <td>
	                                    <span class="label label-primary">Paid</span>
	                                    <span class="label label-success">Active</span>
	                                </td>
	                                <td>John Doe</td>
	                                <td align="center">3435362</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">Today</span> 8:30</td>
	                            </tr>
	                            <tr>
	                                <td>
	                                    <span class="label label-primary">Paid</span>
	                                    <span class="label label-success">Active</span>
	                                </td>
	                                <td>Thomas Bayer</td>
	                                <td align="center">3435362</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">Today</span> 16:30</td>
	                            </tr>
	                            <tr>
	                                <td>
	                                    <span class="label label-primary">Paid</span>
	                                    <span class="label label-default">Inactive</span>
	                                </td>
	                                <td>Nicolas Karabat</td>
	                                <td align="center">3435362</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">Yesterday</span></td>
	                            </tr>
	                            <tr>
	                                <td>
	                                    <span class="label label-default">Unpaid</span>
	                                    <span class="label label-default">Inactive</span>
	                                </td>
	                                <td>Alexandre Pome</td>
	                                <td align="center">3435362</td>
	                                <td class="color-blue-grey" nowrap align="center">23th May</td>
	                            </tr>
	                            <tr>
	                                <td>
	                                    <span class="label label-primary">Paid</span>
	                                    <span class="label label-success">Active</span>
	                                </td>
	                                <td>John Doe</td>
	                                <td align="center">3435362</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">Today</span> 8:30</td>
	                            </tr>
	                            <tr>
	                                <td>
	                                    <span class="label label-primary">Paid</span>
	                                    <span class="label label-success">Active</span>
	                                </td>
	                                <td>Thomas Bayer</td>
	                                <td align="center">3435362</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">Today</span> 16:30</td>
	                            </tr>
	                            <tr>
	                                <td>
	                                    <span class="label label-primary">Paid</span>
	                                    <span class="label label-default">Inactive</span>
	                                </td>
	                                <td>Nicolas Karabat</td>
	                                <td align="center">3435362</td>
	                                <td class="color-blue-grey" nowrap align="center"><span class="semibold">Yesterday</span></td>
	                            </tr>
	                            <tr>
	                                <td>
	                                    <span class="label label-default">Unpaid</span>
	                                    <span class="label label-default">Inactive</span>
	                                </td>
	                                <td>Alexandre Pome</td>
	                                <td align="center">3435362</td>
	                                <td class="color-blue-grey" nowrap align="center">23th May</td>
	                            </tr>
	                        </table>
	                    </div><!--.box-typical-body-->
	                </section><!--.box-typical-dashboard-->
	            </div><!--.col-->
	            <div class="col-xl-6 dahsboard-column">
	                <section class="box-typical box-typical-dashboard panel panel-default scrollable">
	                    <header class="box-typical-header panel-heading">
	                        <h3 class="panel-title">Recent tickets</h3>
	                    </header>
	                    <div class="box-typical-body panel-body">
	                        <table class="tbl-typical">
	                            <tr>
	                                <th><div>Status</div></th>
	                                <th><div>Subject</div></th>
	                                <th align="center"><div>Department</div></th>
	                                <th align="center"><div>Date</div></th>
	                            </tr>
	                            <tr>
	                                <td>
	                                    <span class="label label-success">Open</span>
	                                </td>
	                                <td>Website down for one week</td>
	                                <td align="center">Support</td>
	                                <td nowrap align="center"><span class="semibold">Today</span> 8:30</td>
	                            </tr>
	                            <tr>
	                                <td>
	                                    <span class="label label-success">Open</span>
	                                </td>
	                                <td>Restoring default settings</td>
	                                <td align="center">Support</td>
	                                <td nowrap align="center"><span class="semibold">Today</span> 16:30</td>
	                            </tr>
	                            <tr>
	                                <td>
	                                    <span class="label label-warning">Progress</span>
	                                </td>
	                                <td>Loosing control on server</td>
	                                <td align="center">Support</td>
	                                <td nowrap align="center"><span class="semibold">Yesterday</span></td>
	                            </tr>
	                            <tr>
	                                <td>
	                                    <span class="label label-danger">Closed</span>
	                                </td>
	                                <td>Authorizations keys</td>
	                                <td align="center">Support</td>
	                                <td nowrap align="center">23th May</td>
	                            </tr>
	                        </table>
	                    </div><!--.box-typical-body-->
	                </section><!--.box-typical-dashboard-->
	                
	            </div><!--.col-->
	        </div>
	    </div><!--.container-fluid-->
	</div>
@endsection